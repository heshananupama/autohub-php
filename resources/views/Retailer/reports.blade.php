@extends('Retailer/index')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <form action="{{url('/retailer/generateReports')}}"
                      method="post"> {{ csrf_field() }}
                <h2><strong>Report Generation </strong></h2><br><br>
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="SortBy" class="control-label">
                            Report Type</label>

                        <select id="sortby" name="reportType" type="text"
                                class="form-control">
                            <option value="">Select a Report type</option>
                            <option value="orders">Orders</option>
                            <option value="sales">Sales</option>
                            <option value="inventory">Inventory</option>

                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="SortBy" class="control-label">
                            Sort By</label>

                        <select id="sortby" name="frequency" type="text"
                                class="form-control">
                            <option value="">Select a Time Frequency</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>

                        </select>
                    </div>
                </div>

                    <input type="submit" class="btn btn-success" style="margin-top: 25px;"  value="Generate Report">
                </form>

            </div>
            @if(!empty($categories) )

            <br><br> <div class="row">
                <div class="col-sm-3">


                </div>
                <div class="col-sm-6 text-center">
                    <h2 style="display: inline" align="center">Weekly Sales Report</h2>
                    <img src="/Images/gfvLogo.png" style="width: 96px; height: 72px;" alt="">
                </div>
                    <div class="col-sm-3">


                    </div>
            </div>
                <br>
            <div class="row">
                <div class="col-sm-6 text-center">
                    <h3 style="margin-left: 10px;margin-bottom: 0px;margin-top: 0px; ">Reporting Period:</h3> <h4 > <strong>{{$reportStartDate}} to {{$reportEndDate}}</strong>  </h4 ><br>

                </div>
                <div class="col-sm-6 text-center" >
                    <h3 style="margin-left: 10px;margin-bottom: 0px;margin-top: 0px; ">Reporting Date:</h3> <h4 > <strong> {{Carbon\Carbon::now() }}</strong>  </h4 ><br>

                </div>
            </div>


            <br><br>
            <table class="table table-bordered" id="reportingTable">


                <tr >

                    <th>Date</th>
                    @foreach($categories as $category)

                    <th>{{$category->categoryName}}</th>
                   @endforeach


                    <th>Sub Total</th>
                </tr>
                     <tr>

                        @foreach($reportData as $date => $array)
                            <tr>
                                <?php $a = 0; ?>

                                <td>{{ $date }}
                                </td>

                                <td>
                                    <?php $a=$a+ $array['Electrical'];?>
                                    {{ $array['Electrical'] }}</td>
                                <td>
                                    <?php $a=$a+ $array['Electronics'];?>

                                    {{ $array['Electronics'] }}
                                </td>

                                <td>
                                    <?php $a=$a+ $array['Lights'];?>

                                    {{ $array['Lights'] }}
                                </td>
                                <td>
                                    <?php $a=$a+ $array['Body'];?>

                                    {{ $array['Body'] }}
                                </td>

                                <td>
                                    <?php $a=$a+ $array['Exhaustions'];?>

                                    {{ $array['Exhaustions'] }}
                                </td>
                                <td>
                                    <?php $a=$a+ $array['Transmission'];?>

                                    {{ $array['Transmission'] }}
                                </td>
                                <td>
                                    <?php $a=$a+ $array['Suspension'];?>

                                    {{ $array['Suspension'] }}
                                </td>
                                <td>
                                    <?php $a=$a+ $array['Engine'];?>

                                    {{ $array['Engine'] }}
                                </td>
                                    <td>
                                        <?php echo $a?>

                                     </td>


                            </tr>

                            @endforeach
  {{--
                <tbody id="tableModel">

                @foreach($spares as $spare)

                    <tr>
                        <td>{{$spare->partNumber}}</td>
                        <td>{{ $spare->description}}</td>

                        <td>
                            {{$spare->brand->brandName}}
                        </td>
                        <td>{{$spare->model->modelName}}</td>
                        <td>{{$spare->category->categoryName}}</td>
                        <td>{{$spare->model->yearOfManufacture}}</td>

                        <td>{{$spare->model->fuelType}}</td>
                        <td>{{$spare->model->transmissionType}}</td>

                        <td>{{$spare->quantity}}</td>
                        <td>{{'Rs.'. $spare->price}}</td>
                        <td>{{$spare->warranty}}</td>


                        <td>
                            <div class="image">
                                <a href="{{ asset("/Images/spares/$spare->imagePath") }}"><img style="width: 50px;height: 50px;"
                                                                                               src='{{ asset("images/spares/$spare->imagePath") }}'></a>
                            </div>
                        </td>
                        <td>

                            <a style="margin-bottom: 5px;" onclick="EditSpare({{$spare->id}},'{{$spare->partNumber}}','{{$spare->description}}','{{$spare->brand->brandName}}','{{$spare->quantity}}','{{$spare->price}}','{{$spare->warranty}}','{{$spare->category->categoryName}}')" class=" btn btn-success btn-xs" data-toggle="modal" data-target="#modalEdit">Edit </a>

                            <a onclick="DeleteSpare({{$spare->id}})" style=""
                               class=" btn btn-danger btn-xs">Delete </a>

                        </td>

                    </tr>


                @endforeach
                </tbody>
--}}


            </table>
                @endif
        </div>
    </div>

@endsection