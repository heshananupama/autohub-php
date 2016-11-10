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
            <div class="table-responsive table-bordered">
                <table  class="table ">


                    <tr>
                        <th>Spare Id</th>
                        <th>Part Number</th>
                        <th>Description</th>

                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Warranty</th>
                        <th>Spare Image</th>

                        <th>


                            <input   type="text" class="form-control" id="search" placeholder="Search Spare">
                        </th>


                    </tr>
                    <tbody id="tableModel">
                    <?php
                    foreach($spares as $spare){

                    ?>
                    <tr>
                        <td ><?php echo $spare->id;?></td>
                        <td ><?php echo $spare->partNumber;?></td>
                        <td ><?php echo $spare->description;?></td>

                        <td ><?php echo $spare->quantity;?></td>
                        <td ><?php echo 'Rs.'. $spare->price;?></td>
                        <td ><?php echo $spare->warranty;?></td>


                        <td><div class="image"><?php echo ' <img  class="img-responsive"  src="data:image/jpeg;base64,'.base64_encode( $spare->image ).'"/>';?></div></td>
                        <td>

                            <a class=" btn btn-success btn-sm" data-toggle="modal" data-target="#modalEdit" onclick="EditBrand('<?php echo $brand->brandName;?>','<?php echo $brand->id;?>')" >Edit </a>

                            <a onclick="DeleteBrand(<?php echo $brand->id;?>)" style="" class=" btn btn-danger btn-sm"  >Delete </a>

                        </td>

                    </tr>

                    <?php }?>
                    </tbody>


                </table>

            </div>


            <div style="text-align: center">
                <button  class="btn btn-success btn-md" data-toggle="modal"
                         data-target="#modalSpare">Add New
                </button>
            </div>

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

                    <form enctype="multipart/form-data" action="{{url('/retailer/spares')}}" method="post"> {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 ">
                                <div class="form-group">

                                    <input  style="margin-bottom: 5px;" placeholder="Part Number" type="text"
                                            class="form-control" name="partNumber"
                                            value="{{old('modelName')}}"/>



                                    <select id="brandDropdown" name="brandId"  class="form-control" onchange="getNewModels()" required>
                                        <option value="">Select a Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id}}">{{ $brand->brandName}}</option>

                                        @endforeach
                                    </select>


                                    <select   id="newModel" name="modelId" type="text"
                                            class="form-control" required>
                                        <option value="" >  Select a Model</option>

                                    </select>




                                    {{--<select style="margin-bottom: 5px;" class="form-control" name="category"
                                            id="transmission">
                                        <option value="">Select a Category </option>
                                        <option value="Engine">Engine</option>
                                        <option value="Light">Lights</option>

                                    </select>--}}

                                   {{-- <select style="margin-bottom: 5px;" class="form-control" name="fuelType" id="fuel">
                                        <option value="">Select Fuel Type</option>
                                        <option value="Hybrid/Petrol">Hybrid/Petrol</option>
                                        <option value="Hybrid/Diesel">Hybrid/Diesel</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Petrol">Petrol</option>

                                    </select>--}}


                                    <select style="margin-bottom: 5px;" class="form-control" name="warranty" id="warranty">
                                        <option value="">Select a Warranty period</option>
                                        <option value="3m">3-Months</option>
                                        <option value="6m">6-Months</option>
                                        <option value="1y">1-Year</option>
                                        <option value="2y">2-Years</option>

                                    </select>


                                  {{--  <select id="newYear" name="newYear" type="text"
                                            class="form-control" required>
                                        <option value=""  >Select a Year</option>

                                    </select>
--}}
                                    <input  style="margin-bottom: 5px;" placeholder="Quantity" type="number"
                                            class="form-control" name="quantity"
                                            value="{{old('quantity')}}"/>
                                    <input  style="margin-bottom: 5px;" placeholder="Price" type="number"
                                            class="form-control" name="price"
                                            value="{{old('price')}}"/>

                                    <input  style="margin-bottom: 5px;" placeholder="Description" type="text"
                                            class="form-control" name="description"
                                            value="{{old('description')}}"/>


                                    <input  id="retailer_id" style="display: none" type="text" class="form-control" name="retailerId"
                                           value=" {{ Auth::user()->id }} "/>


                                    <label class="control-label">Select image to upload:</label>
                                    <input  type="file" name="image" id="image">

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