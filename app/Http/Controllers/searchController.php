<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\OrderItem;
use App\Orders;
use App\ShoppingCart;
use Illuminate\Http\Request;

use App\Http\Requests\SpareDataRequest;
use App\Http\Requests;
use App\Spares;
use App\Retailers;


use Auth;
use Illuminate\Support\Facades\Session;
use Log;
use App\User;
use Illuminate\Support\Facades\Redirect;

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
        $spares = null;
        $search = "";
        if ($request->searchName) {
            $search = $request->searchName;
            $spares = Spares::with('user', 'model')
                ->where('description', 'LIKE', '%' . $request->searchName . '%')
                ->get();
        }

        return View::make('browse')->with('spares', $spares)->with('search', $search);

    }

    public function loadProduct($id)
    {

        $product = Spares::with('brand', 'model')
            ->where('id', $id)->get();


        return View::make('productDetails')->with('product', $product);

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
                $spareId = $item->spare_id;
                $spare = Spares::find($spareId);
                $subTotal = $item->quantity * $spare->price;
                $orderItem->subTotal = $subTotal;
                $order = Orders::orderBy('created_at', 'desc')->first();
                $orderItem->order_id = $order->id;

                $orderItem->save();


            }


        }

        DB::table('shoppingCart')
            ->where('id', $cart->id)
            ->update(['isCheckedOut' => 'y']);



    }

    /* public function getAddToCart(Request $request){

         $oldValue=0;

         if ($request->session()->has('val')) {
             $oldValue = $request->session()->get('val');
         }

         $cart = new Cart($oldValue);
         $cart->add();
         session(['val' => $cart]);
         dd($request->session()->get('val'));

      }*/


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


            /*  DB::update("update spares
         set  quantity=quantity-'$quantity'  where id = $spareId");*/

        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
}
