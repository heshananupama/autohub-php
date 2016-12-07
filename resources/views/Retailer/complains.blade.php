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
            <h2><strong>Manage Complains </strong></h2><br>

            <div class="table-responsive ">
                <table class="table table-bordered  table-inverse" id="spareTable">


                    <tr>
                        <th>Spare</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Telephone</th>

                        <th>Complain</th>
                        <th>Spare Image</th>

                    </tr>
                    <tbody id="tableModel">

                    @foreach($complains as $complain)

                        <tr>
                            <td>{{$complain->spdescription}}</td>
                            <td>{{$complain->name}}</td>
                            <td>{{$complain->email}}</td>
                            <td>{{$complain->phoneNumber}}</td>

                            <td>{{$complain->description}}</td>
                            <td>
                                <div class="image">
                                    <a href="{{ asset("/Images/spares/$complain->imagePath") }}"><img style="width: 50px;height: 50px;"
                                                                                                   src='{{ asset("images/spares/$complain->imagePath") }}'></a>
                                </div>
                            </td>



                        </tr>


                    @endforeach
                    </tbody>


                </table>

            </div>




        </div>


    </div>



@endsection