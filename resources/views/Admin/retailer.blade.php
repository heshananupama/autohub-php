

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
                    <h2 style="text-align: center">Retailers</h2><br>
                    <div class="col-sm-1">
                    </div>

                    <div class="col-sm-10">
                        <div class="table-bordered table-responsive">
                            <table class="table vehicle_brand">



                                <tr>
                                    <th>Retailer Id</th>
                                    <th>Shop Name</th>
                                    <th>Address</th>
                                    <th>Contact No</th>
                                    <th>Delete</th>



                                </tr>

                                <tbody id="tableRetailer">
                                <?php
                                foreach($retailers as $retailer){

                                ?>
                                <tr>
                                    <td ><?php echo $retailer->id;?></td>
                                    <td ><?php echo $retailer->shopName;?></td>
                                    <td ><?php echo $retailer->address;?></td>
                                    <td ><?php echo $retailer->contactNo;?></td>

                                    <td>


                                        <a onclick="DeleteRetailer(<?php echo $retailer->id;?>)" style="" class=" btn btn-danger btn-sm"  >Delete </a>

                                    </td>

                                </tr>

                                <?php }?>
                                </tbody>



                            </table>
                        </div>

                    </div>
                    <div class="col-sm-1">

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>




    {{--
    Delete Modal
    --}}

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
    <div style="text-align: center">
        {{ $retailers->links() }}

    </div>

    <script>

        $('#search').on('keyup', function () {
            var value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{url('/admin/brand/search/')}}',
                data: {'search': value},
                success: function (data) {
                    $('#tableBrand').html("");
                    $('#tableBrand').html(data);


                }


            });
        });
    </script>
@endsection