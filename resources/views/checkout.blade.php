@extends('index')

@section('content')
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <!-- Success messages -->
            <div class="alert alert-warning alert-autocloseable-warning" id="successMessage">
            </div>

        </div>
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1>Checkout</h1>

            <h4>Your Total: Rs.{{ $total }}.00</h4>
            <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : ''  }}">
                {{ Session::get('error') }}
            </div>
            <br>
            <form name="theForm" id="theForm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="currency_code" value="LK">

                <input type="hidden" name="upload" value="1">

                <input type="hidden" name="business" value="heshananupama@msn.com">

                <input type="hidden" value="2" name="rm">
                <input type="hidden" name="return" value="http://autohub.com/home">
                <input type="hidden" name="cancel_return" value="autohub.com/home">

                <input type="hidden" name="item_name_1" value="Autohub Cart Total">
                <input type="hidden" id="amountTotal" name="amount_1" value="{{$total}}">
                <br>
                <div class="row">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="" />
                            </div>
                            <span class="text-danger"> </span>
                        </div>


                </div>
                <br>
                <div class="row">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-certificate"></span></span>
                            <input type="text" id="address" name="city" class="form-control" placeholder="Enter Address" maxlength="50" value="" />
                        </div>
                        <span class="text-danger"> </span>
                    </div>


                </div>
                <br>
                <div class="row">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="text" name="email" class="form-control" placeholder="Enter email" maxlength="50" value="" />
                        </div>
                        <span class="text-danger"> </span>
                    </div>


                </div>

                <div class="row">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                            <input type="text"
                                   name="telephone"
                                   required class="form-control" placeholder="Enter Phone Number" maxlength="50" value="" />
                        </div>
                     </div>


                </div>




                {{ csrf_field() }}
                <a type="submit" class="btn btn-success" onclick="submitform({{$total}})">Buy now</a>
            </form>

        </div>
    </div>
    <br><br>
@endsection