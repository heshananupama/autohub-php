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
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                </div>
                <div class="row">
                    <h2 style="text-align: center">Manage Categories</h2><br>
                    <div class="col-sm-1">
                    </div>

                    <div class="col-sm-10">
                        <div class="table-bordered table-responsive">
                            <table class="table vehicle_brand">


                                <tr>

                                    <th>Category Id</th>
                                    <th>Category Name</th>
                                    <th>

                                        </span>
                                        <button class="btn btn-default btn-md" data-toggle="modal"
                                                data-target="#modalCategory">Add New
                                        </button>

                                        <input style="margin-top: 10px; width:250px; " type="text" class="form-control"
                                               id="search" placeholder="Search Category">

                                    </th>


                                </tr>

                                <tbody id="tableModel">
                                <?php
                                foreach($categories as $category){

                                ?>
                                <tr>
                                    <td><?php echo $category->id;?></td>
                                    <td><?php echo $category->categoryName;?></td>


                                    <td>
                                        <a onclick="EditCategory(<?php echo $category->id;?>,'<?php echo $category->categoryName;?>')"
                                           class=" btn btn-success btn-sm" data-toggle="modal"
                                           data-target="#categoryEdit">Edit </a>
                                        <a onclick="DeleteCategory(<?php echo $category->id;?>)"
                                           class=" btn btn-danger btn-sm">Delete </a>
                                    </td>
                                </tr>

                                <?php }?>

                                </tbody>


                                {{--<tr>
                                    <td > 1</td>
                                    <td> Engine</td>
                                    <td>

                                        <a class=" btn btn-success btn-sm" data-toggle="modal" data-target="#modalEdit" onclick="testEdit( )" >Edit </a>

                                        <a style="" class=" btn btn-danger btn-sm" href="  url('/admin/brand/delete') " >Delete </a>

                                    </td>
                                </tr>--}}


                            </table>

                        </div>

                        <div style="text-align: center">
                            {{ $categories->links() }}

                        </div>
                    </div>
                    <div class="col-sm-1">

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{--add new brand modal--}}
    <div class="modal fade bs-example-modal-lg" id="modalCategory" tabindex="-1" style="margin-top:130px;" role="dialog"
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
                        <span id="text-login-msg">Type new category name.</span>
                    </div>
                </div>
                <div class="modal-body">

                    <form action="{{url('/admin/category')}}" method="post"> {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10 ">
                                <div class="form-group">

                                    <input autofocus type="text" class="form-control" name="categoryName"
                                           value="{{old('categoryName')}}"/>

                                    <input style="display: none" type="text" class="form-control" name="admin_id"
                                           value=" {{ Auth::user()->id }} "/>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-md" onclick="">Save</button>
                                    </div>


                                </div>
                            </div>

                            <div class="col-md-1"></div>
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

    <div class="modal fade bs-example-modal-lg" id="categoryEdit" tabindex="-1" style="margin-top:130px;" role="dialog"
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
                        <span id="text-login-msg">Enter new category name.</span>
                    </div>
                </div>
                <div class="modal-body">

                    <form action="{{url('/admin/category/edit/')}}" method="post"> {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10 ">
                                <div class="form-group">

                                    <input type="text" class="form-control" name="categoryName" id="categoryNameM"
                                           value="{{old('categoryName')}}"/>

                                    <input readonly type="text" class="form-control" name="categoryId" id="categoryIdM"
                                           style="display: none"/>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-md" onclick="">Save</button>
                                    </div>


                                </div>
                            </div>

                            <div class="col-md-1"></div>
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


    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
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

    <script>

        $('#search').on('keyup', function () {
            var value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{url('/admin/category/search/')}}',
                data: {'search': value},
                success: function (data) {
                    $('#tableCategory').html("");
                    $('#tableCategory').html(data);


                }


            });
        });
    </script>
@endsection


<table  class="table ">


    <tr>
        <th>Spare Id</th>
        <th>Part Number</th>
        <th>Name</th>
        <th>Brand</th>

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

        <td>
            <?php

            $brand="SELECT brandName FROM brands WHERE id=' $spare->brand_id'";

            ?>
        </td>

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
