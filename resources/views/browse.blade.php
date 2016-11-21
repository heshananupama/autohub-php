
@extends('index')

@section('content')
    <h1 style="font-family: Calibri;font-size: 40px"   align="center">Search Results for BMW</h1><br>
     <div class="panel-default" style="margin:20px 100px;">
        <div class="panel-heading">Refinements </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="condition" class="control-label">
                            Condition</label>

                        <select id="condition" name="condition" type="text"
                                class="form-control" required>
                            <option value="">Brand New</option>
                            <option value="">Re Condition</option>
                            <option value="">Any Condition</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">

                    <div class="form-group">
                        <label for="condition" class="control-label">
                            Price From</label>

                        <input   id="price1"  name="priceFrom" type="number"
                                 placeholder="Rs." class="form-control" required/>
                    </div>

                </div>

                <div class="col-sm-2">

                    <div class="form-group">
                        <label for="condition" class="control-label">
                            Price To</label>


                        <input   id="price2"  name="priceTo" type="number"
                                 placeholder="Rs." class="form-control" required/>

                    </div>

                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="SortBy" class="control-label">
                            Sort By</label>

                        <select id="sortby" name="sortby" type="text"
                                class="form-control" required>
                            <option value="">Name</option>
                            <option value="">Price</option>
                            <option value="">Part Category</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">

                    <div class="form-group">
                        <label for="condition" class="control-label">
                            Car Model</label>

                        <select id="model" name="condition" type="text"
                                class="form-control" required>
                            <option value="">All</option>

                            <option value="">BMW i3 BEV</option>
                            <option value="">BMW 330e M </option>
                            <option value="">BMW 520D</option>
                        </select>
                    </div>

                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="condition" class="control-label">
                            Part Category</label>

                        <select id="category" name="condition" type="text"
                                class="form-control" required>
                            <option value="">Alternator</option>
                            <option value="">Bearings</option>
                            <option value="">Belts</option>
                            <option value="">Body Parts</option>
                            <option value="">Braking System</option>
                            <option value="">Cables</option>
                            <option value="">Clutch</option>
                            <option value="">Drivetrain</option>
                            <option value="">Electricals</option>
                            <option value="">Electronics</option>
                            <option value="">Engine parts</option>
                            <option value="">Filters</option>
                            <option value="">Gaskets</option>
                            <option value="">Belts</option>


                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <table class="table table-hover">

                        <tbody>
                        @foreach($spares as $spare)

                            <tr>
                            <td class="col-md-6">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                                                  src='{{ asset("images/spares/$spare->imagePath") }}'
                                                                                  style="width: 100px; height: 100px;padding-left: 10px"> </a>
                                    <div  class="media-body"  style="padding-left: 10px;">

                                        <h4 class="media-heading"><a href="#">{{$spare->description}}</a></h4>
                                        <h5 class="media-heading"> by <a href="#">{{$spare->user->name }}</a></h5>
                                    </div>
                                </div>
                            </td>

                            <td class="col-md-1 text-center"><strong>Rs. {{$spare->price}}/=</strong></td>
                            <td class="col-md-1">
                                <button type="button" class="btn btn-success">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                                </button>
                            </td>
                        </tr>
                        @endforeach


                        </tbody>
                    </table>





            </div>
        </div>
    </div>
    <br>
    <br><br><br><br><br><br><br><br><br><br>

    @endsection
