@extends('Retailer/index')

@section('content')
    <div class="col-xs-6 col-xs-offset-3">
        <!-- Success messages -->
        <div class="alert alert-success alert-autocloseable-success" id="successMessage">
        </div>

    </div>
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
            <h2><strong>Manage Enquiries </strong></h2><br>

            <div class="table-responsive ">
                <table class="table table-bordered  table-inverse" id="spareTable">


                    <tr>
                        <th>Customer Name</th>
                        <th>Message</th>
                        <th>Contact Number</th>
                        <th>email</th>


                    </tr>
                    <tbody id="tableModel">

                    @foreach($enquiries as $enquiry)


                            <tr>
                                <td style="width: 100px;">{{$enquiry->name}}</td>
                                <td>{{$enquiry->message}}</td>
                                <td>{{$enquiry->contactNo}}</td>
                                <td>{{$enquiry->email}}</td>
                            </tr>


                    @endforeach
                    </tbody>


                </table>

            </div>




        </div>


    </div>
    @endsection