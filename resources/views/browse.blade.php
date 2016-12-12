@extends('index')

@section('content')
    <h1 style="font-family: Calibri;font-size: 40px" align="center">Search Results for " {{$search}} "</h1><br>

{{--
        <div class="panel-heading">Refinements</div>
--}}

            <form action="{{url('/browse/filter')}}" method="get">
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-2">
                    <div class="form-group">
                        <label for="condition" class="control-label">
                            Brand</label>

                        <select onchange="getNewModels()" id="brandDropdown" name="brand" type="text"
                                class="form-control"  >
                            <option value="">Select a Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->brandName}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-xs-3">

                    <div class="form-group">
                        <label for="model" class="control-label">
                            Car Model</label>

                        <select id="model" name="model" type="text"
                                class="form-control"  >
                            <option value=""> Model-Transmission-Year-Fuel-Engine</option>

                        </select>
                    </div>

                </div>

                <div class="col-xs-2">
                    <div class="form-group">
                        <label for="SortBy" class="control-label">
                            Sort By</label>

                        <select id="sortby" name="sortby" type="text"
                                class="form-control"  >
                            <option value="">Select Field to Sort</option>
                            <option value="Name">Name</option>
                            <option value="priceAscending">Price Low to High</option>
                            <option value="priceDescending">Price High to Low</option>

                        </select>
                    </div>
                </div>



                <div class="col-xs-2">
                    <div class="form-group">
                        <label for="condition" class="control-label">
                            Part Category</label>

                        <select id="category" name="category" type="text"
                                class="form-control"  >
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->categoryName}}</option>
                            @endforeach


                        </select>
                    </div>
                </div>
                <div class="col-xs-2">
                    <input name="searchName" type="hidden" style="display: none" value="{{$search}}">
                    <div class="form-group">
                        <input style="margin-top: 30px; float: left"  class="btn btn-default btn-sm" type="submit">

                    </div>
                </div>

            </div>
            </form>
    <br>
    <div class="col-xs-6 col-xs-offset-3">
        <!-- Success messages -->
        <div class="alert alert-success alert-autocloseable-success" id="successMessage">
         </div>

    </div>


     <div class="container">
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
            </div>
        </div>
    </div>
    <br>
    <br><br><br><br><br><br><br><br><br><br>

@endsection
