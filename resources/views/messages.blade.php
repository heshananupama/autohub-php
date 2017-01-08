@extends('index')

@section('content')
    <div id="page-content-wrapper">
        <div class="page-content">
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


                <div class="row">
                    <h1 style="text-align: center">Inbox</h1><br>
                    <div class="col-sm-1">
                    </div>

                    <div class="col-sm-10">
                        <div class="table-responsive table-bordered">
                            <table class="table table-hover ">


                                <tr style="height: 50px;">
                                    <th style="text-align: center">Retailer Name</th>

                                    <th style="text-align: center">Message Type</th>
                                    <th style="text-align: center">Order Item Name</th>
                                    <th style="text-align: center">Order Date</th>

                                    <th style="text-align: center">Message Date</th>
                                    <th style="text-align: center">Message</th>

                                </tr>
                                <tbody id="tableModel">
                                @foreach($messages as $message)
                                    <tr>
                                        <td>{{$message->retailer->name}}</td>

                                        <td>{{$message->messageType}}</td>
                                        <?php $a=0?>
                                        @foreach($orderItems as $orderItem)
                                            @if($orderItem->id==$message->orderItem_id)
                                                <td>{{$orderItem->spare->description}}</td>
                                                <td>{{$orderItem->order->orderDate}}</td>
                                                <?php $a=1?>
                                            @endif
                                        @endforeach

                                        @if($a==0)
                                            <td>-</td>
                                            <td>-</td>
                                            @endif

                                        <td>{{$message->created_at}}</td>
                                        <td>{{$message->message}}</td>


                                    </tr>
                                @endforeach


                                </tbody>

                            </table>

                        </div>
                        <div style="text-align: center">

                        </div>

                    </div>
                    <div class="col-sm-1">

                    </div>
                </div>

            </div>
        </div>

    </div>
    <br><br><br><br>
@endsection