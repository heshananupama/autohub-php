

@extends('index')

@section('content')
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <!-- Success messages -->
            <div class="alert alert-success alert-autocloseable-success" id="successMessage">
            </div>

        </div>
    </div>

    <div class="row" style="margin: 20px 100px;">
        <div class="col-xs-2">

        </div>
        <div class="col-xs-8">
            <h2>Order Details</h2><br>
            <div class="panel-default">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="condition" class="control-label">
                                    Customer Name</label><br>
                                <label style="color: rosybrown" for="Customer Name" class="control-label">
                                    {{ Auth::user()->name }} </label>

                                {{--<input   id="price1"  name="priceFrom" type="number"
                                         placeholder="" class="form-control" required/>--}}
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="condition" class="control-label">
                                    Order ID</label>
                                {{--<label for="Customer Name" class="control-label">
                                    Heshan Perera</label>--}}


                                    <select id="orderDropdown" name="orderId" class="form-control"
                                            onchange="loadOrderItems(this.value)" required>
                                        <option value="">Select an Order</option>
                                        @foreach($orders as $order)
                                        <option value="{{ $order->id}}">{{ $order->id}}</option>

                                        @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="condition" class="control-label">
                                    Order Date</label><br>
                                @if(!empty ($orderDate))
                                <label id="dateLabel" style="color: rosybrown" for="Customer Name"
                                       class="control-label">{{$orderDate}}
                                </label>
                                @endif
                                {{--<input   id="orderID"  name="orderDate" type=""
                                         placeholder="" class="form-control" required/>--}}
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <h4>Items in the order</h4><br>

            <div class="row">
                <div class="col-xs-12">
                    <table style="margin-left: auto;
margin-right: auto;" width="100%" class="table-responsive feedbackTable">

                        <tr>
                            <th>Item Name</th>
                            <th>Item Image</th>
                            <th>Item Status</th>
                            <th>Add Review</th>
                            <th>Make Complain</th>

                        </tr>

                        @if(!empty ($orderItems))

                            <tbody id="tableFeedback">
                            @foreach($orderItems as $orderItem)

                                <tr>
                                    <td>
                                        {{$orderItem->spare->description}}
                                    </td>

                                    <td>

                                        <img
                                                src='/images/spares/{{$orderItem->spare->imagePath}}'
                                                style="width: 65px; height: 65px; "><img
                                        />
                                    </td>
                                    <td>
                                        {{$orderItem->orderStatus}}
                                    </td>
                                    <td>
                                        <a class=" btn btn-success btn-sm" onclick="showReviewModal({{$orderItem->id}})"  >Add Review </a>

                                    </td>
                                    <td>
                                        <a class=" btn btn-warning btn-sm"  onclick="showComplainModal({{$orderItem->id}})" >Add Complain </a>

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        @endif
                        <tr>


                        </tr>
                    </table>
                </div>


            </div>


        </div>
        <div class="col-xs-2">

        </div>
    </div>
    <br><br><br><br><br><br>

    {{--
    Review Modal
    --}}

    <div class="modal fade bs-example-modal-lg" id="modalReview" tabindex="-1" style="margin-top:120px;" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <img class="img-circle" width="75px" height="75px" src="/images/review.png">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <br>
                    <div id="div-register-msg">
                        <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                        <span id="text-register-msg">Add a Review.</span>
                    </div>
                </div>
                <div class="modal-body">


                    <div class="container">
                        <div class="row" style="margin-top:40px;">
                            <div class="col-md-6">
                                <div class="well well-sm">

                                     <div class="row" id="post-review-box"  >
                                        <div class="col-md-12">
                                                 <input id="ratings-hidden" name="rating" type="hidden">
                                                <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>

                                                <div class="text-right">
                                                    <div class="stars starrr" data-rating="0"></div>
                                                    <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                                        <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                                    <button class="btn btn-success btn-sm" onclick="saveReview()">Save</button>
                                                </div>

                                            <input id="orderItemId" name="orderItemId" style="display: none"  value=" ">

                                        </div>
                                    </div>
                                 </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>



    {{-- Complain Modal --}}

    <div class="modal fade bs-example-modal-lg" id="modalComplain" tabindex="-1" style="margin-top:120px;" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <img class="img-circle" width="75px" height="75px" src="/images/complaint.png">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <br>
                    <div id="div-register-msg">
                        <br>
                        <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                        <span id="text-register-msg">Add a Complain.</span>
                    </div>
                </div>
                <div class="modal-body">


                    <div class="container">
                        <div class="row">

                        </div>
                        <div class="row" style="margin-top:40px;">
                            <div class="col-md-6">
                                <div class="well well-sm">

                                    <div class="row" id="post-review-box"  >
                                        <div class="col-md-12">
                                            <input class="form-control" id="phoneNumber" name="phone"   placeholder="Telephone Num:"><br>
                                            <textarea class="form-control animated" cols="50" id="new-complain" name="comment" placeholder="Enter your complain here..." rows="5"></textarea>

                                            <br>
                                            <button style="float: right" id="complainId" name="complainId"  class="btn btn-success bt-sm" onclick="saveComplain()">Save</button>
                                            <input id="complainItemId" name="complainItemId" style="display: none"  value=" ">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection


