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
            <h2><strong>Manage Enquiries </strong></h2><br>

            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped" id="spareTable">


                    <tr>
                        <th style="text-align: center">Customer Name</th>
                        <th  style="text-align: center">Message</th>
                        <th  style="text-align: center">Contact Number</th>
                        <th style="text-align: center">Email</th>
                        <th style="text-align: center">Reply</th>



                    </tr>
                    <tbody id="tableModel">

                    @foreach($enquiries as $enquiry)


                            <tr>
                                <td style="width: 100px;">{{$enquiry->user->name}}</td>
                                <td>{{$enquiry->message}}</td>
                                <td>{{$enquiry->contactNo}}</td>
                                <td>{{$enquiry->user->email}}</td>
                                <td>   <a onclick="makeReply({{$enquiry->user->id}})" style=""
                                          class=" btn btn-success btn-sm">Reply</a></td>
                            </tr>


                    @endforeach
                    </tbody>


                </table>

            </div>




        </div>


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

                                    <input style="display: none" type="text" class="form-control" id="customerId" name="customer"
                                           value=""/><br>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-md" onclick="replyCustomer()">Save</button>
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



@endsection