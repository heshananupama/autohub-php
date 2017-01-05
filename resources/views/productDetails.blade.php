@extends('index')

@section('content')

    <div class="container">
        <div class="col-xs-6 col-xs-offset-3">
            <!-- Success messages -->
            <div class="alert alert-success alert-autocloseable-success" id="successMessage">
            </div>

        </div>
        <div class="row">
            @if(Session::has('flash_message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <strong> {!! session('flash_message') !!} </strong>
                </div>
            @endif
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <strong>There were some problems</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

        </div>

        <div class="row">
            @foreach($product as $prod)


                <div class="row">

                    <div class="col-sm-6 ">
                        <div class="panel panel-default" style="height: 300px;">
                            <div style="margin: 0 auto" class="image">
                                <a href="{{ asset("images/spares/$prod->imagePath") }}">

                                <img class="img-responsive center-block"  style="width: 200px; height: 200px; margin-top: 50px;";
                                       src='{{ asset("images/spares/$prod->imagePath") }}' alt=""></a>
                            </div>
                        </div>

                     </div>

                    <div class="col-sm-6">

                            <h3 ><strong>{{$prod->description}}</strong></h3>
                        <div class="row">
                            @if(!empty($overallRating))

                                <div >
                                   <div style="margin: 0px;" class="stars starrr"  data-rating=" {{$overallRating}}">   </div>
                                </div>
                            @endif
                        </div>
                              <h3><strong>Rs. {{$prod->price}}.00</strong><br></h3>


                             <div class="form-group" style="margin-bottom: 0px;"><br>
                                <label  for="quantity">Quantity:</label>
                                <input style="width: 70px; margin-left: 250px;" type="number" class="form-control" id="quantity" onblur="checkQuantity({{$prod->id}},value)">

                                 <br>
                                 <a href="{{ url()->previous() }}" type="button" class="btn btn-default btn-lg">
                                     <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                 </a>


                                 @if($prod->quantity<=0)
                                     <button disabled  id="addToCart" class="btn btn-success btn-lg">
                                         <span  class="glyphicon glyphicon-shopping-cart"></span>Add to Cart
                                     </button>
                                     <span  class="glyphicon glyphicon-warning-sign"><label
                                                 style="margin-right: 120px;margin-top: 20px; font-family: 'Arial Black'; ">OUT OF STOCK</label></span>


                                 @elseif($prod->quantity!=0)
                                     <button   id="addToCart" class="btn btn-success btn-lg"  onclick="shoppingCart({{$prod->id}})">
                                         <span  class="glyphicon glyphicon-shopping-cart"></span>Add to Cart
                                     </button>
                                     <span class="glyphicon glyphicon-ok-sign"><label
                                         >IN STOCK</label></span>
                                 @endif




                              </div>




                         <br>
                             <label id="productQuantity" style="margin-left: 5px; color: red; font-family: 'Arial Black'; "></label>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="well">
                        <u><h3>Additional Info.</h3></u>
                        <br>
                        <table border="2px" width="100%" class="table-bordered" id="productDetails">
                            <tr>
                                <td height="50px" width="250px">SpareID</td>
                                <td width="250px" height="50px">{{$prod->id}}</td>
                            </tr>
                            <tr>
                                <td>Part Number</td>
                                <td>{{$prod->partNumber}}</td>
                            </tr>

                            <tr>
                                <td height="50px" width="250px">Warranty</td>
                                <td height="50px" width="250px">{{$prod->warranty}}</td>
                            </tr>
                            <tr>
                                <td height="50px" width="250px">Vehicle Brand</td>
                                <td height="50px" width="250px">{{$prod->brand->brandName}}</td>
                            </tr>
                            <tr>
                                <td>Vehicle Model</td>
                                <td>{{$prod->model->modelName}}</td>
                            </tr>
                            <tr>
                                <td>Model Year</td>
                                <td>{{$prod->model->yearOfManufacture}}</td>
                            </tr>
                            <tr>
                                <td>Fuel Type</td>
                                <td>{{$prod->model->fuelType}}</td>
                            </tr>
                            <tr>
                                <td>Transmission</td>
                                <td>{{$prod->model->transmissionType}}</td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>{{$prod->category->categoryName}}</td>

                            </tr>

                        </table>


                    </div>
                </div>


         @endforeach
        </div>
        <div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3><u>Product Reviews</u></h3><br><br>
                        @foreach($reviewItems as $reviewItem)
                            <div class="container">

                                <div class="row">
                                    <div class="col-sm-2">

                                    </div>
                                    <div class="col-sm-1">
                                        <div class="thumbnail">
                                            <img class="img-responsive user-photo" src="/images/user.png">
                                        </div><!-- /thumbnail -->
                                    </div><!-- /col-sm-1 -->

                                    <div class="col-sm-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <strong>{{$reviewItem->name}}</strong> <span class="text-muted">Purchased on {{ $reviewItem->created_at}}</span>
                                            </div>
                                            <div class="panel-body">
                                                {{$reviewItem->description}}

                                            </div>
                                                 <div >
                                                    <div style="margin: 0px;" class="stars starrr"  data-rating="{{$reviewItem->rating}}"></div>
                                                </div>
                                            </div>
                                            <!-- /panel-body -->
                                        </div><!-- /panel panel-default -->




                                    </div><!-- /col-sm-5 -->




                                    <div class="col-sm-3">

                                    </div>


                                </div><!-- /row -->

                            </div><!-- /container -->


                        @endforeach

                    </div>
                <br>

                <br><br><br><br>

                </div>

            </div>

        </div>

    </div>
    <br>
    @endsection