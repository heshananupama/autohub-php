@extends('Admin/index')

@section('content')
     <div id="page-content-wrapper">
        <div class="page-content">
                 <div class="row">

                    @if(Session::has('flash_message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <strong> {!! session('flash_message') !!} </strong>
                        </div>
                    @endif


                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">
                        <img style="text-align: center" class="img-circle" width="75px" height="75px" id="img_logo"
                             src="/Images/registerImage.png">
                        <h5>Register Retailers</h5>
                    </div>


                    <div class="panel-body">

                        <form  enctype="multipart/form-data" class="form-horizontal" role="form" method="POST"
                              action="{{ url('/admin/registerRetailer/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required
                                           autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}"
                                           required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>


                            <div class="form-group{{ $errors->has('shopName') ? ' has-error' : '' }}">
                                <label for="shopName" class="col-md-4 control-label">Shop Name</label>

                                <div class="col-md-6">
                                    <input id="shopName" type="text" class="form-control" name="shopName"
                                           value="{{ old('shopName') }}" required>

                                    @if ($errors->has('shopName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('shopName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{ old('address') }}"
                                           required>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('contactNo') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Contact No.</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="contactNo"
                                           value="{{ old('contactNo') }}"
                                           required>

                                    @if ($errors->has('contactNo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contactNo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation"
                                           required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('retailerImage') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Select an Image</label>

                                <div class="col-md-6">
                                    <input value='retailerImage' class="form-control" type="file" name="retailerImage" id="image">

                                    @if ($errors->has('retailerImage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('retailerImage') }}</strong>
                                    </span>
                                    @endif


                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


        </div>
    </div>

@endsection