@extends('index')

@section('content')
    <form name="advanceSearchForm" action="{{url('/browse/filter')}}" method="get">
        <div class="row">

            <div class="col-sm-3">
                <div style="display: none" class="form-group">
                    <label for="SortBy" class="control-label">
                        Sort By</label>

                    <select id="sortby" name="sortby" type="text"
                            class="form-control">
                        <option value="">Select Field to Sort</option>
                        <option value="Name">Name</option>
                        <option value="priceAscending">Price Low to High</option>
                        <option value="priceDescending">Price High to Low</option>

                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="condition" class="control-label">
                        Brand</label>

                    <select onchange="getNewModels()" id="brandDropdown" name="brand" type="text"
                            class="form-control">
                        <option value="">Select a Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->brandName}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="model" class="control-label">
                        Car Model</label>

                    <select id="model" name="model" type="text"
                            class="form-control" onchange="dispayImage()">
                        <option value=""> Model-Transmission-Year-Fuel-Engine</option>

                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div style="display: none" class="form-group">
                    <label for="condition" class="control-label">
                        Part Category</label>

                    <select id="category" name="category" type="text"
                            class="form-control">
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->categoryName}}</option>
                        @endforeach


                    </select>
                </div>
            </div>
            <div style="display: none" class="col-sm-1">
                <input id="searchID" name="searchName" type="hidden" style="display: none" value="">
                <div class="form-group">
                    <input style="margin-top: 30px; float: left" class="btn btn-default btn-sm" type="submit">

                </div>
            </div>
        </div>

    </form>
    <br>

    <h3 id="headId"  >Please Select a Part from the following Image</h3>
    <br>

    <img id="carImage" style="visibility:hidden " src="/Images/carparts3.jpg" alt="" usemap="#Map">
    <br><br><br><br><br>
    <map name="Map" id="Map">

        <area alt="" class="tooltip" title="Brake Pads" onclick="advancedSearch('Brake')" shape="poly"
              coords="87,241,77,259,99,263,105,242"/>
        <area alt="" class="tooltip" title="Pistons & Rings"  onclick="advancedSearch('Piston')"  shape="poly" coords="386,379,388,447,424,449,417,380" />

    </map>
    <br>
@endsection