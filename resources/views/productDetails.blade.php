@extends('index')

@section('content')

    <div class="container">

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
                            </h4><br>
                            <h4>RS 3000.00</h4><br>
                            <label  class="control-label">Quantity:</label>
                        
                            <input style="width: 50px" type="text" class="form-control" placeholder="1">

                            <button type="button" class="btn btn-success btn-lg">
                                Add To Cart <span class="glyphicon glyphicon-shopping-cart"></span>
                            </button>
                            <span class="glyphicon glyphicon-ok-sign"><label
                                        style="margin-left: 5px; font-family: 'Arial Black'; ">IN STOCK</label></span>
                         {{--<div class="ratings">
                            <a href=""><p>3 reviews</p></a>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                4.0 stars
                            </p>
                        </div>
--}}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="well">
                        <u><h3>Additional Info.</h3></u>
                        <br>
                        <table class="table-bordered">
                            <tr>
                                <td height="50px" width="250px">SpareID</td>
                                <td width="250px" height="50px">25482</td>
                            </tr>
                            <tr>
                                <td>Part Number</td>
                                <td>KFO0342501</td>
                            </tr>
                            <tr>
                                <td>Manufacturer</td>
                                <td>Mahle</td>
                            </tr>
                            <tr>
                                <td height="50px" width="250px">Warranty</td>
                                <td height="50px" width="250px">Not Applicable</td>
                            </tr>
                            <tr>
                                <td height="50px" width="250px">Vehicle Brand</td>
                                <td height="50px" width="250px">TATA</td>
                            </tr>
                            <tr>
                                <td>Vehicle Models</td>
                                <td>Indica</td>
                            </tr>
                            <tr>
                                <td>Model Year</td>
                                <td>2008</td>
                            </tr>
                            <tr>
                                <td>Fuel Type</td>
                                <td>Petrol/Diesel</td>
                            </tr>
                            <tr>
                                <td>Transmission</td>
                                <td>Manual</td>
                            </tr>

                        </table>


                    </div>
                </div>








            </div>
@endforeach
        </div>

    </div>

    @endsection