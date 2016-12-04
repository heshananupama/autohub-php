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
            <div class="col-md-3">
                <p class="lead">Other Sellers</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Jayawardena Motors</a>
                    <a href="#" class="list-group-item">Rainbow Motors</a>
                    <a href="#" class="list-group-item">WestEnd Motors</a>
                </div>
            </div>

            <div class="col-md-9">

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

                            <h4 style="float: left">{{$prod->description}}
                             <br> <br>
                                Rs. {{$prod->price}}.00</h4><br><br>

                             <div class="form-group"><br>
                                <label style="float: left;" for="quantity">Quantity:</label>
                                <input style="width: 70px;" type="number" class="form-control" id="quantity" onblur="checkQuantity({{$prod->id}},value)">

                                 <br>
                                <button style="float: left;" id="addToCart" class="btn btn-success btn-lg"  onclick="shoppingCart({{$prod->id}})">
                                    <span  class="glyphicon glyphicon-shopping-cart"></span>Add to Cart
                                </button>

                                @if($prod->quantity>0)

                                <span class="glyphicon glyphicon-ok-sign"><label
                                            style="margin-right: 120px;margin-top: 20px;">IN STOCK</label></span>



                                @elseif($prod->quantity<=0)
                                         <span  class="glyphicon glyphicon-warning-sign"><label
                                                    style="margin-right: 120px;margin-top: 20px; font-family: 'Arial Black'; ">OUT OF STOCK</label></span>


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
                                <td>Manufacturer</td>
                                <td>Mahle</td>
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

                        </table>


                    </div>
                </div>


            </div>
@endforeach
        </div>

    </div>

    @endsection