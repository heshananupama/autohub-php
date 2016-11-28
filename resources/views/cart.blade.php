
@extends('index')

@section('content')

<h1 style="font-family: Calibri;font-size: 52px"   align="center">Shopping Cart</h1><br>
<div class="container">

    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">

                        @if(!empty ($items))
                <table class="table table-hover">
                    <?php $a = 0; ?>

                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <td></td>

                        @foreach($items as $item)

                <tr>

                    <td class="col-sm-7 col-md-5">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                                        src='/images/spares/{{$item->spare->imagePath}}'
                                                                          style="width: 72px; height: 72px; "><img
                                /> </a>
                            {{--<div class="image">
                                <a href="{{ asset("images/spares/$item->spare->imagePath") }}"><img style="width: 50px;height: 50px;"
                                                                                              src='/images/spares/{{$item->spare->imagePath}}'></a>
                            </div>--}}
                            <div class="media-body" style="padding-left: 10px;">
                                <h4 class="media-heading"><a href="#"> {{$item->spare->description}}</a></h4>
                             </div>
                        </div>
                    </td>
                    <td class="col-sm-1 col-md-1" style="text-align: center">
                        <label class="form-control" id="InputQuantity1">{{$item->quantity}}</label>
                    </td>
                    <td class="col-sm-2 col-md-2 text-center"><strong>Rs. {{$item->spare->price}}</strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong><?php
                                echo ('Rs. '. $item->quantity *$item->spare->price );
                             ?> </strong></td>
                    <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-danger" onclick="deleteCartItem({{$item->id}})">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button>
                    </td>
                    @php
                        $a = $a+$item->quantity *$item->spare->price;
                    @endphp

                </tr>
                        @endforeach
                    <tr>

                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong><?php echo 'Rs. ' .$a;?></strong></h3></td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td>
                            <a type="button" class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                            </a>
                        </td>
                        <td>
                            <a href="{{route('checkout')}}" type="button" class="btn btn-success btn-lg">
                                Checkout <span class="glyphicon glyphicon-play"></span>
                            </a>
                        </td>
                    </tr>
                        @else()
                            <h2>There are no items in the Cart</h2><br><br><br><br><br><br><br><br><br><br><br><br><br>
                            <br>
                            @endif




                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete a<b><i class="title"></i></b> cart item, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-ok">Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection
