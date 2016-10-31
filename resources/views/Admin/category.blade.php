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
                        <table class="table-responsive vehicle_brand">



                            <tr>

                                <th>Category Id</th>
                                <th>Category Name</th>
                                <th>

                                    </span>
                                    <button class="btn btn-default btn-md" data-toggle="modal"
                                            data-target="#modalBrand">Add New
                                    </button>
                                </th>


                            </tr>



                            <tr>
                                <td > 1</td>
                                <td> Engine</td>
                                <td>

                                    <a class=" btn btn-success btn-sm" data-toggle="modal" data-target="#modalEdit" onclick="testEdit( )" >Edit </a>

                                    <a style="" class=" btn btn-danger btn-sm" href="  url('/admin/brand/delete') " >Delete </a>

                                </td>
                            </tr>




                        </table>
                    </div>
                    <div class="col-sm-1">

                    </div>
                </div>
            </div>
        </div>

    </div>

{{--add new brand modal--}}
<div class="modal fade bs-example-modal-lg" id="modalBrand" tabindex="-1" style="margin-top:130px;" role="dialog"
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
                    <span id="text-login-msg">Type new brand name.</span>
                </div>
            </div>
            <div class="modal-body">

                <form action="{{url('/admin/brand')}}" method="post"> {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 ">
                            <div class="form-group">

                                <input autofocus type="text" class="form-control" name="brandName"
                                       value="{{old('brandName')}}"/>

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

<div class="modal fade bs-example-modal-lg" id="modalEdit" tabindex="-1" style="margin-top:130px;" role="dialog"
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
                    <span id="text-login-msg">Enter new brand name.</span>
                </div>
            </div>
            <div class="modal-body">

                <form action="{{url('/admin/brand/edit/')}}" method="post"> {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 ">
                            <div class="form-group">

                                <input  type="text" class="form-control" name="brandName"
                                        value="{{old('brandName')}}"/>

                                <input readonly type="text" class="form-control" name="id" id="id" style="display: none" />


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
@endsection