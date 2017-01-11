<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Brands;
use App\Models;
use App\Categories;
use App\CartItem;
use App\OrderItem;
use App\Orders;
use App\ShoppingCart;
use Illuminate\Http\Request;


use App\Spares;


use Auth;
use Log;
use Illuminate\Support\Facades\Redirect;
use App;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\View;

class searchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $brands = Brands::all();
        $models = Models::all();
        $categories = Categories::all();
        $spares = null;
        $search = "";
        if ($request->searchName) {
            $search = $request->searchName;
            $spares = Spares::with('user', 'model', 'brand')
                ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->get();

        }
        $spareCount=$spares->count();

        return View::make('browse')->with('spares', $spares)->with('sparesCount', $spareCount)->with('brands', $brands)->with('models', $models)->with('categories', $categories)->with('search', $search);

    }

    public function loadProduct($id)
    {
        $rating = 0;
        $index = 0;

        $product = Spares::with('brand', 'model', 'category')
            ->where('id', $id)->get();

        $orderItems = DB::table('feedback')->where('feedbackType', '=', 'Review')
            ->join('orderItem', 'feedback.orderItem_id', '=', 'orderItem.id')->join('users', 'feedback.user_id', '=', 'users.id')->get();


        foreach ($orderItems as $key => $orderItem) {
            if (($orderItem->spare_id) != $id) {
                unset($orderItems[$key]);
            }
        }
        foreach ($orderItems as $key => $orderItem) {
            if ($orderItem->rating != null) {
                $rating = $rating + $orderItem->rating;
                $index++;
            }

        }
        if ($rating != 0 && $index != 0) {
            $overallRating = $rating / $index;
            $overallRating=round($overallRating);
            return View::make('productDetails')->with('product', $product)->with('reviewItems', $orderItems)->with('overallRating', $overallRating);
        } else {
            return View::make('productDetails')->with('product', $product)->with('reviewItems', $orderItems);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkQuantity(Request $request)
    {

        if ($request->ajax()) {
            $id = $request->productId;
            $product = Spares::find($id);

            $quantity = $product->quantity;
            if ($quantity < $request->quantity) {
                return $quantity;
            } else {
                return "false";
            }

        }

    }


    public function changeCartStatus(Request $request)
    {
        $user_id = Auth::user()->id;
        $cart = DB::table('shoppingCart')->where('user_id', $user_id)->where('isCheckedOut', '=', 'n')->first();
        $shippingAddress = $request->address;
        $total = $request->cartTotal;
        $orders = new Orders();
        $orders->orderDate = date('Y-m-d');
        $orders->shippingAddress = $shippingAddress;
        $orders->orderTotal = $total;
        $orders->user_id = $user_id;
        $orders->save();
        if (count($cart) == 1) {
            $items = CartItem::with('spare', 'shoppingCart')
                ->where('cart_id', $cart->id)->get();
            foreach ($items as $item) {
                $orderItem = new OrderItem();
                $orderItem->quantity = $item->quantity;
                $orderItem->spare_id = $item->spare_id;
                $spareId = $item->spare_id;
                $spare = Spares::find($spareId);
                $subTotal = $item->quantity * $spare->price;
                $totalCost = $item->quantity * $spare->cost;
                $orderItem->totalCost = $totalCost;
                $orderItem->subTotal = $subTotal;
                $order = Orders::orderBy('created_at', 'desc')->first();
                $orderItem->order_id = $order->id;
                $orderItem->save();
                $spare = Spares::find($item->spare_id);
                $newQuantity = $spare->quantity - $item->quantity;
                DB::table('spares')
                    ->where('id', $item->spare_id)
                    ->update(['quantity' => $newQuantity]);
            }
        }
        DB::table('shoppingCart')
            ->where('id', $cart->id)
            ->update(['isCheckedOut' => 'y']);
        /*  DB::table('spares')
              ->where('id', $cart->id)
              ->update(['isCheckedOut' => 'y']);*/
        /*        DB::update("update spares
                 set  quantity=quantity-'$quantity'  where id = $spareId");*/
    }


    public function addToCart(Request $request)
    {
        $user_id = 0;
        $users = null;
        $spareId = $request->id;
        $quantity = $request->quantity;

        if (\Auth::check()) {
            $user_id = Auth::user()->id;

        }
        if ($request->ajax()) {
            $users = DB::table('shoppingCart')->where('isCheckedOut', '=', 'n')->where('user_id', $user_id)->get();
            if (count($users)) {

            } else {

                $shoppingCart = new ShoppingCart;
                $shoppingCart->isCheckedOut = 'n';
                $shoppingCart->user_id = $user_id;

                if (Auth::guest()) {
                    $shoppingCart->temporary = 'y';
                } else {
                    $shoppingCart->temporary = 'n';
                }

                $shoppingCart->save();
            }


            $cart = DB::table('shoppingCart')->where('user_id', $user_id)->where('isCheckedOut', '=', 'n')->first();
            $spare = DB::table('cartItem')->where('spare_id', $spareId)->where('cart_id', $cart->id)->first();
            if (count($spare)) {
                $newQuantity = $spare->quantity + $quantity;

                DB::table('cartitem')
                    ->where('id', $spare->id)
                    ->update(['quantity' => $newQuantity]);
                return "Item Quantity Updated";

                /*   DB::update("update cartitem
         set  quantity=quantity+'$quantity'   where id = $spare->id");*/
            } else {

                $cartItem = new CartItem;
                $cartItem->quantity = $quantity;
                $cartItem->spare_id = $spareId;
                $cartItem->cart_id = $cart->id;
                $cartItem->save();


                return "Item Added to the Cart";
            }


        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function filterResults(Request $request)
    {
        $search = "";
        $brand = $request->brand;
        $sortBy = $request->sortby;
        $model = $request->model;
        $category = $request->category;

        $brands = Brands::all();
        $models = Models::all();
        $categories = Categories::all();
        $spares = null;
        if ($request->searchName) {
            $search = $request->searchName;


            if ($category == "" && $sortBy == "" && $model == "" && $brand == "") {
                $spares = Spares::with('user', 'model', 'brand')
                    ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->get();

            } else if ($brand == "" && $sortBy == "" && $model == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)
                    ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->get();

            } else if ($category == "" && $sortBy == "" && $model == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('brand_id', '=', $brand)
                    ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->get();

            } else if ($category == "" && $sortBy == "" && $brand == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)
                    ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->get();

            } else if ($category == "" && $model == "" && $brand == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'desc')->get();

                }

            } else if ($model == "" && $brand == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'desc')->get();

                }
            } //sortby and other fields

            else if ($category == "" && $brand == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'desc')->get();

                }
            } else if ($category == "" && $model == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('brand_id', '=', $brand)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('brand_id', '=', $brand)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('brand_id', '=', $brand)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'desc')->get();

                }
            }
            //end sortby and other fields

            //start brand and other fields
            else if ($model == "" && $sortBy == "") {

                $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)
                    ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->get();
            } else if ($category == "" && $sortBy == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)
                    ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->get();

            }
            //end brand and other fields

            //start model and other fields

            else if ($brand == "" && $sortBy == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('category_id', '=', $category)
                    ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->get();

            } //end model other fields


            else if ($sortBy == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)->where('model_id', '=', $model)
                    ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->get();

            } else if ($brand == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('model_id', '=', $model)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('model_id', '=', $model)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('model_id', '=', $model)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'desc')->get();

                }

            } else if ($model == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'desc')->get();

                }

            } else if ($category == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                     $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'desc')->get();

                }

            } else if ($category != "" && $brand != "" && $sortBy != "" && $model != "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)->where('category_id', $category)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)->where('category_id', $category)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)->where('category_id', $category)
                        ->where('description', 'LIKE', '%' . $request->searchName . '%')->orWhere('partNumber', 'LIKE', '%' . $request->searchName . '%')->orderBy('price', 'desc')->get();

                }

            }
            $spareCount=$spares->count();

            return View::make('browse')->with('spares', $spares)->with('sparesCount', $spareCount)->with('brands', $brands)->with('models', $models)->with('categories', $categories)->with('search', $search);


        } else {


            if ($brand == "" && $sortBy == "" && $model == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)
                    ->get();

            } else if ($category == "" && $sortBy == "" && $model == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('brand_id', '=', $brand)
                    ->get();

            } else if ($category == "" && $sortBy == "" && $brand == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)
                    ->get();

            } else if ($category == "" && $model == "" && $brand == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')
                        ->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')
                        ->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')
                        ->orderBy('price', 'desc')->get();

                }

            } else if ($model == "" && $brand == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)
                        ->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)
                        ->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)
                        ->orderBy('price', 'desc')->get();

                }
            } //sortby and other fields

            else if ($category == "" && $brand == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)
                        ->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)
                        ->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)
                        ->orderBy('price', 'desc')->get();

                }
            } else if ($category == "" && $model == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('brand_id', '=', $brand)
                        ->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('brand_id', '=', $brand)
                        ->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('brand_id', '=', $brand)
                        ->orderBy('price', 'desc')->get();

                }
            }
            //end sortby and other fields

            //start brand and other fields
            else if ($model == "" && $sortBy == "") {

                $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)
                    ->get();
            } else if ($category == "" && $sortBy == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)
                    ->get();

            }
            //end brand and other fields

            //start model and other fields

            else if ($brand == "" && $sortBy == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('category_id', '=', $category)
                    ->get();

            } //end model other fields


            else if ($sortBy == "") {
                $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)->where('model_id', '=', $model)
                    ->get();

            } else if ($brand == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('model_id', '=', $model)
                        ->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('model_id', '=', $model)
                        ->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('model_id', '=', $model)
                        ->orderBy('price', 'desc')->get();

                }

            } else if ($model == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)
                        ->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)
                        ->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('category_id', '=', $category)->where('brand_id', '=', $brand)
                        ->orderBy('price', 'desc')->get();

                }

            } else if ($category == "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)
                        ->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    dd("dd");
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)
                        ->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)
                        ->orderBy('price', 'desc')->get();

                }

            } else if ($category != "" && $brand != "" && $sortBy != "" && $model != "") {
                if ($sortBy == "Name") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)->where('category_id', $category)
                        ->orderBy('description', 'asc')->get();

                } elseif ($sortBy == "priceAscending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)->where('category_id', $category)
                        ->orderBy('price', 'asc')->get();

                } elseif ($sortBy == "priceDescending") {
                    $spares = Spares::with('user', 'model', 'brand')->where('model_id', '=', $model)->where('brand_id', '=', $brand)->where('category_id', $category)
                        ->orderBy('price', 'desc')->get();

                }

            }

            $spareCount=$spares->count();
            if ($request->suspension) {
                return View::make('suspension')->with('spares', $spares)->with('sparesCount', $spareCount)->with('brands', $brands)->with('models', $models)->with('categories', $categories);

            } else {
                return View::make('toyota')->with('sparesCount', $spareCount)->with('spares', $spares)->with('brands', $brands)->with('models', $models)->with('categories', $categories);

            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getCheckout($price)
    {

        return View::make('checkout')->with('total', $price);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function toyota()
    {
        $brands = Brands::all();
        $models = Models::all();
        $categories = Categories::all();
        $spares = null;
        $search = "";

        $spares = Spares::with('user', 'model', 'brand')
            ->where('brand_id', 1)->get();


        return View::make('toyota')->with('spares', $spares)->with('brands', $brands)->with('models', $models)->with('categories', $categories)->with('search', $search);

    }

    public function suspension()
    {
        $brands = Brands::all();
        $models = Models::all();
        $categories = Categories::all();
        $spares = null;
        $search = "";

        $spares = Spares::with('user', 'model', 'brand')
            ->where('category_id', 8)->get();


        return View::make('suspension')->with('spares', $spares)->with('brands', $brands)->with('models', $models)->with('categories', $categories)->with('search', $search);

    }

    public function viewCart()
    {
        $user_id = Auth::user()->id;


        $cart = DB::table('shoppingCart')->where('user_id', $user_id)->where('isCheckedOut', '=', 'n')->first();


        if (count($cart) == 1) {
            $items = CartItem::with('spare', 'shoppingCart')
                ->where('cart_id', $cart->id)->get();


            return View::make('cart')->with('items', $items);
        } else {
            return View::make('cart');
        }


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartItem = CartItem::find($id);
        $cartItem->delete();
        return Redirect::to('/cart');
    }

    public function advance()
    {
        $brands = Brands::all();
        $models = Models::all();
        $categories = Categories::all();
        return View::make('advanceSearch')->with('brands', $brands)->with('models', $models)->with('categories', $categories);

    }
}
