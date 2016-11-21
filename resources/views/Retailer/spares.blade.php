@extends('Retailer/index')

@section('content')
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
            <h2><strong>Manage Spares </strong></h2>
            <div class="row"><br>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="SortBy" class="control-label">
                            Sort By</label>

                        <select id="sortby" name="sortby" type="text"
                                class="form-control" required>
                            <option value="">Name</option>
                            <option value="">Part Category</option>
                            <option value="">Quantity</option>
                        </select>

                    </div>


                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="SortBy" class="control-label">
                            Vehicle Brand</label>

                        <select id="brand" name="price" type="text"
                                class="form-control" onchange="getBrands(this.value)" required>
                            <option value="">Select a Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->brandName}}">{{ $brand->brandName}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="SortBy" class="control-label">
                            Vehicle Model</label>

                        <select id="model" name="model" type="text"
                                class="form-control" required>
                            <option value="">Select a Model</option>

                        </select>
                    </div>

                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="condition" class="control-label">
                            Condition</label>

                        <select id="condition" name="condition" type="text"
                                class="form-control" required>
                            <option value="">Any Condition</option>
                            <option value="">Brand New</option>
                            <option value="">Re-Condition</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="table-responsive ">
                <table class="table table-bordered  table-inverse" id="spareTable">


                    <tr>
                        <th>Part Number</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>year</th>
                        <th>FuelType</th>
                        <th>Transmission Type</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Warranty</th>
                        <th>Spare Image</th>
                        <th>
                            <input type="text" class="form-control" id="search" placeholder="Search Spare">
                        </th>
                    </tr>
                    <tbody id="tableModel">

                    @foreach($spares as $spare)

                             <tr>
                                <td>{{$spare->partNumber}}</td>
                                <td>{{ $spare->description}}</td>

                                <td>
                                    {{$spare->brand->brandName}}
                                </td>
                                <td>{{$spare->model->modelName}}</td>
                                <td>{{$spare->model->yearOfManufacture}}</td>

                                <td>{{$spare->model->fuelType}}</td>
                                <td>{{$spare->model->transmissionType}}</td>

                                <td>{{$spare->quantity}}</td>
                                <td>{{'Rs.'. $spare->price}}</td>
                                <td>{{$spare->warranty}}</td>


                                <td>
                                    <div class="image">
                                        <a href="{{ asset("images/spares/$spare->imagePath") }}"><img style="width: 50px;height: 50px;"
                                                        src='{{ asset("images/spares/$spare->imagePath") }}'></a>
                                    </div>
                                </td>
                                <td>

                                    <a style="margin-bottom: 5px;" onclick="EditSpare({{$spare->id}},'{{$spare->partNumber}}','{{$spare->description}}','{{$spare->brand->brandName}}','{{$spare->quantity}}','{{$spare->price}}','{{$spare->warranty}}')" class=" btn btn-success btn-xs" data-toggle="modal" data-target="#modalEdit">Edit </a>

                                    <a onclick="DeleteSpare({{$spare->id}})" style=""
                                       class=" btn btn-danger btn-xs">Delete </a>

                                </td>

                            </tr>


                    @endforeach
                    </tbody>


                </table>
                <div style="text-align: center">
                    {{ $spares->links() }}

                </div>
            </div>


            <div style="text-align: center">
                <button style="margin-top: 10px;" class="btn btn-success btn-md" data-toggle="modal"
                        data-target="#modalSpare">Add New
                </button>
            </div>

        </div>


    </div>

    {{--add new spare modal--}}

    <div class="modal fade bs-example-modal-lg" id="modalSpare" tabindex="-1" style="margin-top:100px;" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div>
                        <h3 id="spareModalHeader">Add New Spare</h3>
                    </div>
                </div>
                <div class="modal-body">

                    <form enctype="multipart/form-data" action="{{url('/retailer/spares')}}"
                          method="post"> {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 ">
                                <div class="form-group">

                                    <input style="margin-bottom: 5px;" placeholder="Part Number" type="text"
                                           class="form-control" name="partNumber"
                                           value="{{old('partNumber')}}"/>


                                    <select id="brandDropdown" name="brandId" class="form-control"
                                            onchange="getNewModels()" required>
                                        <option value="">Select a Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id}}">{{ $brand->brandName}}</option>

                                        @endforeach
                                    </select>


                                    <select id="newModel" name="modelId" type="text"
                                            class="form-control" required>
                                        <option value=""> Model-Transmission-Year-Fuel-Engine</option>

                                    </select>


                                    <select style="margin-bottom: 5px;" class="form-control" name="warranty"
                                            id="warranty">
                                        <option value="-">Select a Warranty period</option>
                                        <option value="3-months">3-Months</option>
                                        <option value="6-months">6-Months</option>
                                        <option value="1-year">1-Year</option>
                                        <option value="2-year">2-Years</option>

                                    </select>


                                    <input style="margin-bottom: 5px;" placeholder="Quantity" type="number"
                                           class="form-control" name="quantity"
                                           value="{{old('quantity')}}"/>
                                    <input style="margin-bottom: 5px;" placeholder="Price" type="number"
                                           class="form-control" name="price"
                                           value="{{old('price')}}"/>

                                    <input style="margin-bottom: 5px;" placeholder="Description" type="text"
                                              class="form-control" name="description"
                                              value="{{old('description')}}">



                                    <input id="retailer_id" style="display: none" type="text" class="form-control"
                                           name="retailerId"
                                           value=" {{ Auth::user()->id }} "/>


                                    <label class="control-label">Select image to upload:</label>

                                    <input value="{{old('spareImage')}}" type="file" name="spareImage" id="image">

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-md" onclick="">Save</button>
                                    </div>


                                </div>
                            </div>

                            <div class="col-md-3"></div>
                        </div>
                    </form>

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

    {{--edit spare modal--}}

    <div class="modal fade bs-example-modal-lg" id="modalEditSpare" tabindex="-1" style="margin-top:100px;"
         role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div>
                        <h3>Edit Spare</h3>
                    </div>
                </div>
                <div class="modal-body">

                    <form enctype="multipart/form-data" action="{{url('/retailer/spares/edit')}}"
                          method="post"> {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 ">
                                <div class="form-group">

                                    <input id="partNumberEdit" style="margin-bottom: 5px;" placeholder="Part Number"
                                           type="text"
                                           class="form-control" name="partNumber"
                                           value="{{old('partNumber')}}"/>


                                    <select id="brandEdit" name="brandId" class="form-control"
                                            onchange="getEditModels()" required>
                                        <option value="">Select a Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id}}">{{ $brand->brandName}}</option>

                                        @endforeach
                                    </select>


                                    <select id="modelEdit" name="modelId" type="text"
                                            class="form-control" required>
                                        <option value=""> Model-Transmission-Year-Fuel-Engine</option>

                                    </select>


                                    <select style="margin-bottom: 5px;" class="form-control" name="warranty"
                                            id="warrantyEdit">
                                        <option value="-">Select a Warranty period</option>
                                        <option value="3-months">3-Months</option>
                                        <option value="6-months">6-Months</option>
                                        <option value="1-year">1-Year</option>
                                        <option value="2-year">2-Years</option>

                                    </select>


                                    <input style="margin-bottom: 5px;" placeholder="Quantity" type="number"
                                           id="quantityEdit"
                                           class="form-control" name="quantity"
                                           value="{{old('quantity')}}"/>
                                    <input style="margin-bottom: 5px;" placeholder="Price" type="number"
                                           class="form-control" name="price" id="priceEdit"
                                           value="{{old('price')}}"/>

                                    <input style="margin-bottom: 5px;" placeholder="Description" type="text"
                                              id="descriptionEdit"
                                              class="form-control" name="description"
                                              value="{{old('description')}}"/>


                                    <input id="retailer_idEdit" style="display: none" type="text" class="form-control"
                                           name="retailerId"
                                           value=" {{ Auth::user()->id }} "/>


                                    <label class="control-label">Select image to upload:</label>

                                    <input value="{{old('spareImage')}}" type="file" name="spareImage" id="imageEdit">

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-md" onclick="">Save</button>
                                    </div>

                                    <input id="EditSpareId" readonly type="text" class="form-control" name="id"
                                           style="display: none"/>


                                </div>
                            </div>

                            <div class="col-md-3"></div>
                        </div>
                    </form>

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

    {{--delete modal--}}

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection