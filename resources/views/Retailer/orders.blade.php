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
            <h2><strong>Manage Orders </strong></h2><br>

            <div class="table-responsive ">
                <table class=" table" id="spareTable">


                    <tr>
                        <th style="text-align: center">Order Id</th>
                        <th style="text-align: center">Order Item Id</th>

                        <th style="text-align: center">Order Date</th>
                        <th style="text-align: center">Item</th>
                        <th style="text-align: center">Spare Image</th>
                        <th style="text-align: center">Quantity</th>
                        <th style="text-align: center"> Order Item Value</th>
                        <th style="text-align: center">Shipping Address</th>
                        <th style="text-align: center">Order Item Status</th>
                        <th style="text-align: center"></th>

                    </tr>
                    <tbody id="tableModel">

                    @foreach($orderItems as $orderItem)

                        @if($orderItem->spare->retailer_id== Auth::user()->id)

                        <tr>

                            <td>{{$orderItem->order->id}}</td>
                            <td>{{$orderItem->id}}</td>
                            <td style="width: 100px;">{{$orderItem->order->orderDate}}</td>
                            <td>{{$orderItem->spare->description}}</td>
                            <td>
                                <div class="image">
                                    <a href="{{ asset("/images/spares/{$orderItem->spare->imagePath}") }}"><img style="width: 50px;height: 50px;"
                                                                                                      src="{{ asset("/images/spares/{$orderItem->spare->imagePath}") }}"></a>
                                </div>
                            </td>
                            <td>{{$orderItem->quantity}}</td>
                            <td style="width: 120px;">Rs. {{$orderItem->subTotal}}.00</td>
                            <td>{{$orderItem->order->shippingAddress}}</td>
                            <td>{{$orderItem->orderStatus}}</td>
                            <td>
                                <a style="margin-bottom: 5px;" onclick="showChangeOrderStatusModal({{$orderItem->id}})" class=" btn btn-success btn-xs">Change Status </a>
                            </td>

                        </tr>

                        @endif

                    @endforeach
                    </tbody>


                </table>

            </div>




        </div>


    </div>
    <div class="modal fade bs-example-modal-lg" id="modalOrderItem" tabindex="-1" style="margin-top:130px;" role="dialog"
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
                        <span id="text-login-msg">Select Order Item Status.</span>
                    </div>
                </div>
                <div class="modal-body">


                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10 ">
                                <div class="form-group">

                                    <select  class="form-control" name="orderItemStatus" id="orderItemStatus">
                                        <option value="Purchased">Purchased</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                    <br>
                                    <input style="display: none" type="text" class="form-control" id="orderItemId"
                                           value=""/>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-md" onclick="changeOrderStatus()">Save</button>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-1"></div>
                        </div>




                </div>


            </div>
        </div>
    </div>


@endsection