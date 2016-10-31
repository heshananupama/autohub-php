@extends('Retailer/index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <h2>Manage Spares</h2>
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
                            <option value="" >Select a Model</option>

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
        </div>

        <table class="table table-responsive">


            <tr>
                <th>Spare Id</th>
                <th>Part Number</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Warranty</th>
                <th>Description</th>
                <th>Spare Image</th>

                <th>


                    <input   type="text" class="form-control" id="search" placeholder="Search Spare">
                </th>


            </tr>
            <tbody id="tableModel">

            </tbody>


        </table>
        <div style="text-align: center">
            <button  class="btn btn-success btn-md" data-toggle="modal"
                     data-target="#modalSpare">Add New
            </button>
        </div>



    </div>

    <div class="modal fade bs-example-modal-lg" id="modalSpare" tabindex="-1" style="margin-top:100px;" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div id="div-login-msg">
                        <h3>Add New Spare</h3>
                    </div>
                </div>
                <div class="modal-body">

                    <form action="{{url('/retailer/spare')}}" method="post"> {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 ">
                                <div class="form-group">

                                    <input  style="margin-bottom: 5px;" placeholder="Part Number" type="text"
                                            class="form-control" name="modelName"
                                            value="{{old('modelName')}}"/>

                                    <select name="brandName"  class="form-control" onchange="getNewModels(this.value)" required>
                                        <option value="">Select a Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->brandName}}">{{ $brand->brandName}}</option>

                                        @endforeach
                                    </select>


                                    <select onchange="getNewYears(this.value)" id="newModel" name="newModel" type="text"
                                            class="form-control" required>
                                        <option value="" >Select a Model</option>

                                    </select>


                                    <select style="margin-bottom: 5px;" class="form-control" name="transmissionType"
                                            id="transmission">
                                        <option value="">Select Transmission Type</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>

                                    </select>

                                    <select style="margin-bottom: 5px;" class="form-control" name="fuelType" id="fuel">
                                        <option value="">Select Fuel Type</option>
                                        <option value="Hybrid/Petrol">Hybrid/Petrol</option>
                                        <option value="Hybrid/Diesel">Hybrid/Diesel</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Petrol">Petrol</option>

                                    </select>


                                    <select style="margin-bottom: 5px;" class="form-control" name="warranty" id="warranty">
                                        <option value="">Select a Warranty period</option>
                                        <option value="3m">3-Months</option>
                                        <option value="6m">6-Months</option>
                                        <option value="1y">1-Year</option>
                                        <option value="2y">2-Years</option>

                                    </select>


                                    <select id="newYear" name="newYear" type="text"
                                            class="form-control" required>
                                        <option value=""  >Select a Year</option>

                                    </select>




                                    <input id="admin_id" style="display: none" type="text" class="form-control" name="admin_id"
                                           value=" {{ Auth::user()->id }} "/>

                                    <input id="id" style="display: none" type="text" class="form-control" name="id"
                                           value=" "/>

                                    <label class="control-label">Select image to upload:</label>
                                    <input  type="file" name="file" id="file">

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


    <script>

    </script>
@endsection