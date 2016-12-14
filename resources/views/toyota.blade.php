@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <h2>All Spares for &nbsp; <img style='display:inline;' src='/Images/Logos/toyota.png'/></h2>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-hover">

                    <tbody>
                    @if(!empty ($spares))

                        @foreach($spares as $spare)

                            <tr>
                                <td class="col-xs-6">
                                    <div class="media">
                                        <a class="thumbnail pull-left" href='{{ url("/productInfo/$spare->id") }}'> <img
                                                    class="media-object"
                                                    src='{{ asset("images/spares/$spare->imagePath") }}'
                                                    style="width: 100px; height: 100px;padding-left: 10px"> </a>
                                        <div class="media-body" style="padding-left: 10px;">

                                            <h4 class="media-heading"><a
                                                        href='{{ url("/productInfo/$spare->id") }}'>{{$spare->description}}</a>
                                            </h4>
                                            <h5 class="media-heading"> by <a href="#">{{$spare->user->name }}</a></h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-xs-1 text-center">
                                    <h4 class="media-heading">{{$spare->model->modelName}}</h4>
                                </td>
                                <td class="col-xs-1 text-center">
                                    <h5 class="media-heading"><strong>{{$spare->model->yearOfManufacture}}</strong></h5>
                                </td>


                                <td class="col-xs-1 text-center"><strong>Rs. {{$spare->price}}/=</strong></td>
                                <td class="col-xs-1">
                                    @if($spare->quantity<=0)
                                        <button disabled type="button" class="btn btn-success">
                                            <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                                        </button>
                                    @elseif($spare->quantity!=0)
                                        <button type="button" class="btn btn-success"
                                                onclick="shoppingCart({{$spare->id}})">
                                            <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                                        </button>
                                    @endif
                                </td>
                                <input style="display: none; width: 70px;" type="number" class="form-control"
                                       id="quantity" value="">

                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
                <div>
                    {{ $spares->links() }}

                </div>
            </div>
        </div>
    </div>

@endsection