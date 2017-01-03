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




                 <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-12" >
                        <div class="form-group" >
                            <label for="address">Address</label>
                            <input type="text" name="city" id="address" class="form-control" required>
                        </div>

                    </div>
                    <hr>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="card-name">Email</label>
                            <input type="text" name="email" id="card-name" class="form-control" required>
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