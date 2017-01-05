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

                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <strong>There were some problems</strong>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>

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

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required
                                           autofocus>


                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}"
                                           required>


                                </div>

                            </div>


                            <div class="form-group">
                                <label for="shopName" class="col-md-4 control-label">Shop Name</label>

                                <div class="col-md-6">
                                    <input id="shopName" type="text" class="form-control" name="shopName"
                                           value="{{ old('shopName') }}" required>


                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{ old('address') }}"
                                           required>


                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Contact No.</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="contactNo"
                                           value="{{ old('contactNo') }}"
                                           required>


                                </div>
                            </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" value="{{old('password')}}"  required >


                                    </div>
                                </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" value="{{old('password_confirmation')}}"
                                           required>


                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Select an Image</label>

                                <div class="col-md-6">
                                    <input value='{{old('retailerImage')}}' class="form-control" type="file" name="retailerImage" id="image">




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