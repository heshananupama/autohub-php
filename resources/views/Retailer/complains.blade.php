@extends('Retailer/index')

@section('content')
    <div class="col-xs-6 col-xs-offset-3">
        <!-- Success messages -->
        <div class="alert alert-success alert-autocloseable-success" id="successMessage">
        </div>

    </div>
    <div id="page-wrapper">
        <div class="container-fluid">
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
            <h2><strong>Manage Complains </strong></h2><br>

            <div class="table-responsive ">
                <table class="table table-bordered  table-inverse" id="spareTable">


                    <tr>
                        <th>Order Id</th>
                        <th>Order Item Id</th>
                        <th>Spare</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Telephone</th>

                        <th>Complain</th>
                        <th>Spare Image</th>
                        <th>Reply</th>



                    </tr>
                    <tbody id="tableModel">

                    @foreach($complains as $complain)

                        <tr>
                            <td>{{$complain->orderItem_id}}</td>
                            <td>{{$complain->order_id}}</td>
                            <td>{{$complain->spdescription}}</td>
                            <td>{{$complain->name}}</td>
                            <td>{{$complain->email}}</td>
                            <td>{{$complain->phoneNumber}}</td>

                            <td>{{$complain->description}}</td>
                            <td>
                                <div class="image">
                                    <a href="{{ asset("/Images/spares/$complain->imagePath") }}"><img style="width: 50px;height: 50px;"
                                                                                                   src='{{ asset("images/spares/$complain->imagePath") }}'></a>
                                </div>
                            </td>
                            <td>   <a onclick="makeReply({{$complain->user_id}},{{$complain->orderItem_id}})" style=""
                                      class=" btn btn-success btn-sm">Reply</a></td>



                        </tr>


                    @endforeach
                    </tbody>


                </table>

            </div>

            <div class="modal fade bs-example-modal-lg" id="modalMessage" tabindex="-1" style="margin-top:130px;" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" align="center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <br>
                            <div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-login-msg">Type a Reply.</span>
                            </div>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10 ">
                                    <div class="form-group">

                                    <Textarea id="message" autofocus type="text" class="form-control" name="brandName">

                                    </Textarea>

                                        <input  style="display: none" type="text" class="form-control" id="retailerId" name="retailer"
                                                value=" {{ Auth::user()->id }} "/>

                                        <input  style="display: none" type="text" class="form-control" id="orderItemId" name="orderItem"
                                                value=""/>

                                        <input style="display: none" type="text" class="form-control" id="customerId" name="customer"
                                               value=""/><br>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info btn-md" onclick="replyCustomerComplain()">Save</button>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-1"></div>
                            </div>

                            <!-- Input-->


                        </div>


                        <div class="modal-footer">

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 ">


                                </div>

                                <div class="col-md-2"></div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>



@endsection