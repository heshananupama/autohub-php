@extends('Admin/index')

@section('content')

    <!-- Page content -->
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
                    <h2 style="text-align: center">Manage Models</h2><br>
                    <div class="col-sm-1">
                    </div>

                    <div class="col-sm-10">
                        <div class="table-responsive table-bordered">
                            <table class="table vehicle_brand">


                                <tr>
                                    <th>Model Id</th>
                                    <th>Vehicle Brand</th>
                                    <th>Model Name</th>
                                    <th>Transmission</th>
                                    <th>Fuel</th>
                                    <th>Engine</th>
                                    <th>Make Year</th>
                                    <th>Country</th>

                                    <th>

                                        </span>
                                        <button class="btn btn-default btn-md" data-toggle="modal"
                                                data-target="#modalModel">Add New
                                        </button>
                                        <input style="margin-top: 10px;" type="text" class="form-control" id="search" placeholder="Search Model">
                                    </th>


                                </tr>
                                <tbody id="tableModel">
                                <?php
                                foreach($models as $model){

                                ?>
                                <tr>
                                    <td ><?php echo $model->id;?></td>
                                    <td ><?php echo $model->brandName;?></td>
                                    <td><?php echo $model->modelName;?></td>
                                    <td><?php echo $model->transmissionType;?></td>
                                    <td><?php echo $model->fuelType;?></td>
                                    <td><?php echo $model->engineCapacity;?></td>

                                    <td><?php echo $model->yearOfManufacture;?></td>
                                    <td><?php echo $model->countryMade;?></td>

                                    <td>
                                        <a onclick="EditModel(<?php echo $model->id;?>,'<?php echo $model->modelName;?>','<?php echo $model->brandName;?>',
                                                '<?php echo $model->transmissionType;?>','<?php echo $model->fuelType;?>','<?php echo $model->engineCapacity;?>','<?php echo $model->yearOfManufacture;?>',
                                                '<?php echo $model->countryMade;?>')" class=" btn btn-success btn-sm"
                                        >Edit </a>
                                        <a onclick="DeleteModel(<?php echo $model->id;?>)" class=" btn btn-danger btn-sm">Delete </a>
                                    </td>
                                </tr>

                                <?php }?>

                                </tbody>

                            </table>

                        </div>
                        <div style="text-align: center">
                            {{ $models->links() }}

                        </div>

                    </div>
                    <div class="col-sm-1">

                    </div>
                </div>
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


    {{--add new model modal--}}
    <div class="modal fade bs-example-modal-lg" id="modalModel" tabindex="-1" style="margin-top:100px;" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div id="div-login-msg">
                        <h3>Add New Model</h3>
                    </div>
                </div>
                <div class="modal-body">

                    <form action="{{url('/admin/model')}}" method="post"> {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 ">
                                <div class="form-group">

                                    <select name="brandName"  class="form-control">
                                        <option value="">Select brand name</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->brandName}}">{{ $brand->brandName}}</option>

                                        @endforeach
                                    </select>
                                    <input  style="margin-bottom: 5px;" placeholder="Model Name" type="text" id="newModel"
                                           class="form-control" name="modelName"
                                           value="{{old('modelName')}}"/>
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

                                    <input id="engineCapacity" style="margin-bottom: 5px;" placeholder="Engine Capacity" type="text"
                                           class="form-control" name="engineCapacity"
                                           value="{{old('engineCapacity')}}"/>

                                    <input id="year" style="margin-bottom: 5px;" placeholder="Make Year" type="text"
                                           class="form-control" name="year"
                                           value="{{old('year')}}"/>

                                    <input id="country" style="margin-bottom: 5px;" placeholder="Country" type="text"
                                           class="form-control" name="country"
                                           value="{{old('country')}}"/>

                                    <input id="admin_id" style="display: none" type="text" class="form-control" name="admin_id"
                                           value=" {{ Auth::user()->id }} "/>

                                    <input id="id" style="display: none" type="text" class="form-control" name="id"
                                           value=" "/>

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

    {{--editModal--}}

    <div class="modal fade bs-example-modal-lg" id="modelEdit" tabindex="-1" style="margin-top:130px;" role="dialog"
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
                        <span id="text-login-msg">Enter new Details.</span>
                    </div>
                </div>
                <div class="modal-body">

                    <form action="{{url('/admin/model/edit/')}}" method="post"> {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 ">
                                <div class="form-group">

                                    <select name="brandName" id="brandM" class="form-control">
                                        <option value="">Select brand name</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->brandName}}">{{ $brand->brandName}}</option>

                                        @endforeach
                                    </select>
                                    <input id="modelM" style="margin-bottom: 5px;" placeholder="Model Name" type="text"
                                           class="form-control" name="modelName"
                                           value="{{old('modelName')}}"/>
                                    <select style="margin-bottom: 5px;" class="form-control" name="transmissionType"
                                            id="transmissionM">
                                        <option value="">Select Transmission Type</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>

                                    </select>

                                    <select id="fuelM" style="margin-bottom: 5px;" class="form-control" name="fuelType">
                                        <option value="">Select Fuel Type</option>
                                        <option value="Hybrid/Petrol">Hybrid/Petrol</option>
                                        <option value="Hybrid/Diesel">Hybrid/Diesel</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Petrol">Petrol</option>

                                    </select>

                                    <input id="engineCapacityM" style="margin-bottom: 5px;" placeholder="Engine Capacity" type="text"
                                           class="form-control" name="engineCapacity"
                                           value="{{old('engineCapacity')}}"/>

                                    <input id="yearM" style="margin-bottom: 5px;" placeholder="Make Year" type="text"
                                           class="form-control" name="year"
                                           value="{{old('year')}}"/>

                                    <input id="countryM" style="margin-bottom: 5px;" placeholder="Country" type="text"
                                           class="form-control" name="country"
                                           value="{{old('country')}}"/>

                                    <input style="display: none" type="text" id="modelid" class="form-control" name="modelId"
                                           value=" {{ Auth::user()->id }} "/>

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

    {{--
Delete Modal
--}}



    <script src="/js/jquery-2.2.3.min.js"></script>

    <script>

        $('#search').on('keyup', function () {
            var value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{url('/admin/model/search/')}}',
                data: {'search': value},
                success: function (data) {
                    $('#tableModel').html("");
                    $('#tableModel').html(data);


                }


            });
        });

        $('#home').addClass('active'); // for home page

    </script>

@endsection