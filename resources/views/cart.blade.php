
@extends('index')

@section('content')

<h1 style="font-family: Calibri;font-size: 52px"   align="center">Shopping Cart</h1><br>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Total</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                                          src="Images/SpareParts/Hyundai%20i20%20Shock%20Rear.jpg"
                                                                          style="width: 72px; height: 72px; "><img
                                /> </a>
                            <div class="media-body" style="padding-left: 10px;">
                                <h4 class="media-heading"><a href="#"> Hyundai i10 Shock Rear</a></h4>
                                <h5 class="media-heading"> by <a href="#">G.F.V.Motors</a></h5>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="email" class="form-control" id="InputQuantity1" value="3">
                    </td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>Rs.800.00</strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>Rs.2400.00</strong></td>
                    <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                                          src="Images/SpareParts/LancerBreakPads.jpg"
                                                                          style="width: 72px; height: 72px;padding-left: 10px"> </a>
                            <div  class="media-body"  style="padding-left: 10px;">

                                <h4 class="media-heading"><a href="#">Lancer Break Pads</a></h4>
                                <h5 class="media-heading"> by <a href="#">City Auto Traders</a></h5>
                            </div>
                        </div>
                    </td>
                    <td class="col-md-1" style="text-align: center">
                        <input type="email" class="form-control" id="inputQuantity2" value="2">
                    </td>
                    <td class="col-md-1 text-center"><strong>Rs.750.00</strong></td>
                    <td class="col-md-1 text-center"><strong>Rs.1500.00</strong></td>
                    <td class="col-md-1">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button>
                    </td>
                </tr>

                <tr>

                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>Rs.3900.00</strong></h3></td>
                </tr>
                <tr>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td>
                        <button type="button" class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-lg">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
