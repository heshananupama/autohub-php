@extends('Retailer/index')

@section('content')


    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <form action="{{url('/retailer/generateReports')}}"
                      method="post"> {{ csrf_field() }}
                    <h2><strong>Report Generation </strong></h2><br><br>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="SortBy" class="control-label">
                                    Report Type</label>

                                <select id="reportType" name="reportType" type="text"
                                        onchange="activateReportingPeriod(this.value)"
                                        class="form-control">
                                    <option value="">Select a Report type</option>
                                    <option value="orders">Orders</option>
                                    <option value="sales">Sales</option>
                                    <option value="profit">Profits</option>

                                    <option value="inventory">Inventory</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2" id="reportingPeriodDropDown">
                            <div class="form-group">
                                <label for="SortBy" class="control-label">
                                    Reporting Period</label>

                                <select id="reportFrequency" name="frequency" type="text"
                                        class="form-control" onchange="activateReportDateSelect(this.value)">
                                    <option value="">Select a Time Frequency</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>


                                </select>
                            </div>
                        </div>
                        <div id="dateInput" style="visibility: hidden" class="col-sm-2">
                            <label for="SortBy" class="control-label">
                                Input Date</label>
                            <input placeholder="pick a date" name="oneDate" class="form-control" type="text" id="date"
                                   readonly='true' value=""/>


                        </div>
                        <div id="monthInput" class="col-sm-2" style="visibility: hidden">

                            <label for="SortBy" class="control-label">
                                Input Month </label>
                            <input placeholder="pick a Month" class="form-control" name="monthSelect" id="monthPicker"
                                   readonly='true'   type="text">


                        </div>

                        <div id="yearInput" class="col-sm-2 " style="visibility: hidden">

                            <label for="SortBy" class="control-label">
                                Input Year </label>
                            <input placeholder="pick a Year" class="form-control" name="yearSelect" id="yearPicker"
                                   readonly='true'   type="text">


                        </div>


                        <div class="col-sm-2">
                            <input type="submit" class="btn btn-success" style="margin-top: 25px;" value="Generate ">

                        </div>
                    </div>


                </form>

            </div>

            @if(!empty($categories) && empty($dailyTotal) && empty($spares))


                <div id="content">
                    <div id="splitForPrint" style="border-style: solid">
                        <br>
                        <div class="row">
                            <div class="col-sm-3">


                            </div>
                            <div class="col-sm-6 text-center">
                                <h2 style="display: inline" align="center"><strong>{{$reportHeading}}</strong></h2>

                                <img src='/Images /{{$image}}' style=" width: 96px; height: 72px;" alt="">

                            </div>
                            <div class="col-sm-3">

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <h4 style="margin-left: 10px;margin-bottom: 0px;margin-top: 0px; ">Reporting
                                    Period:</h4>
                                @if(!empty($reportStartDate))
                                    <h5 style="margin-left: 10px;"><strong>{{$reportStartDate}}
                                            to {{$reportEndDate}}</strong></h5><br>
                                @elseif(!empty($year) )
                                    <h5 style="margin-left: 10px;"><strong>{{$year}}
                                        </strong></h5><br>
                                @endif

                            </div>
                            <div class="col-sm-6 text-center">
                                <h4 style="margin-right: 20px;margin-bottom: 0px;margin-top: 0px; ">Reporting Date:</h4>
                                <h5 style="margin-right: 20px;">
                                    <strong> {{Carbon\Carbon::now() }}</strong></h5><br>

                            </div>
                        </div>


                        <table class="table  " id="reportingTable">
                            <thead>
                            <tr>
                                @if(!empty($year) )
                                    <th>Year / Categories</th>


                                @else
                                    <th>Date / Categories</th>

                                @endif

                                @foreach($categories as $category)

                                    <th>{{$category->categoryName}}</th>
                                @endforeach
                                <th>Sub Total</th>
                                @if(!empty($yearlyProfit))
                                    <th>Total Cost</th>
                                    <th>Total Profit</th>
                                @endif


                            </tr>
                            </thead>

                            <tr>

                            @foreach($reportData as $date => $array)

                                <tr class="page-break">

                                    @if(!empty($year))

                                        <td style="width: 25px;">{{  $array['month'] }}
                                    @else

                                        <td style="width: 25px;">{{  $date }}
                                            @endif

                                        </td>

                                        <td>
                                            {{ $array['Electrical'] }}</td>
                                        <td>

                                            {{ $array['Electronics'] }}
                                        </td>

                                        <td>

                                            {{ $array['Lights'] }}
                                        </td>
                                        <td>

                                            {{ $array['Body'] }}
                                        </td>

                                        <td>

                                            {{ $array['Exhaustions'] }}
                                        </td>
                                        <td>

                                            {{ $array['Transmission'] }}
                                        </td>
                                        <td>

                                            {{ $array['Suspension'] }}
                                        </td>
                                        <td>

                                            {{ $array['Engine'] }}
                                        </td>
                                        <td>
                                            {{ $array['Other'] }}

                                        </td>
                                        <td>
                                            {{ $array['subTotal'] }}

                                        </td>
                                        @if(!empty($yearlyProfit))
                                            <td>{{ $array['totalCost'] }}</td>
                                            <td>{{ $array['totalProfit'] }}</td>
                                        @endif


                                </tr>

                            @endforeach
                            <tr class="page-break">

                                <td style="width: 25px;">
                                </td>

                                <td>
                                </td>
                                <td>

                                </td>

                                <td>

                                </td>
                                <td>
                                @if(!empty($yearlyProfit))
                                    <td></td>
                                    <td></td>
                                    @endif
                                    </td>

                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td style="font-size: 20px"><strong>Total</strong></td>
                                    <td style="font-size: 15px;border-top: groove;border-bottom: double"> {{$reportTotal}}</td>


                            </tr>

                        </table>
                        <div class="row">
                            <div class="col-sm-1">

                            </div>
                            <div class="col-sm-3" style="align-content: left">
                                <div class="form-group">
                                    <label for="submitted" class="col-md-4 control-label">Submitted By</label>
                                    <br>
                                    .....................................
                                </div>
                            </div>
                            <div class="col-sm-4">

                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="submitted" class="col-md-4 control-label">Reviewed By</label>
                                    <br>
                                    .....................................
                                </div>
                            </div>
                            <div class="col-sm-1">

                            </div>
                        </div>
                    </div>


                </div>
                <br><br>
                <div class="row">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-2 text-center">
                        <input style="margin-top: 8px;" class="btn btn-success" type="button"
                               onclick="printDiv('splitForPrint')"
                               value="Print Report"/><br>
                    </div>
                    <div class="col-sm-2">


                        <div class="btn-group pull-right" style=" padding: 10px;">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="glyphicon glyphicon-th-list"></span> Import Table As

                                </button>
                                <ul class="dropdown-menu" aria-labelledby="Import as">


                                    <li><a href="#"
                                           onclick="$('#splitForPrint').tableExport({type:'excel',escape:'false'});">
                                            <img src="/Retailer/Libraries/rimages/xls.png" width="24px"> XLS</a></li>
                                    <li><a href="#"
                                           onclick="$('#splitForPrint').tableExport({type:'doc',escape:'false'});">
                                            <img src="/Retailer/Libraries/rimages/word.png" width="24px"> Word</a></li>

                                    </li>


                                    <li><a href="#"
                                           onclick="$('#splitForPrint').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">
                                            <img src="/Retailer/Libraries/rimages/pdf.png" width="24px"> PDF</a></li>

                                </ul>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-4">

                    </div>
                </div>
            @endif


            <div class="row">
                @if(!empty($dailyTotal) && empty($spares) && empty($dailyProfit) && empty($dailyOrders))


                    <div id="content">
                        <div id="splitForPrint" style="border-style: solid">
                            <br>
                            <div class="row">
                                <div class="col-sm-3">


                                </div>
                                <div class="col-sm-6 text-center">
                                    <h2 style="display: inline" align="center"><strong>{{$reportHeading}}</strong></h2>

                                    <img src='/Images /{{$image}}' style=" width: 96px; height: 72px;" alt="">

                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">

                                </div>
                                <div class="col-sm-6   text-center">
                                    <h4 style="margin-left: 10px;margin-bottom: 0px;margin-top: 0px; ">Reporting
                                        Period:</h4>
                                    <h5 style="margin-left: 10px;"><strong>{{$reportDate}}</strong></h5>


                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>


                            <table class="table table-bordered table-hover" id="reportingTable">

                                <thead>
                                <tr>
                                    <th>Part No.</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Item Status</th>
                                    <th>Sub Total</th>
                                </tr>


                                </thead>
                                <tr>

                                @foreach($dailySales as $sale)

                                    <tr>

                                        <td>{{ $sale->spare->partNumber }}
                                        </td>

                                        <td>
                                            {{ $sale->spare->description }}</td>
                                        <td>

                                            {{ $sale->quantity }}
                                        </td>
                                        <td>
                                            {{ $sale->orderStatus }}
                                        </td>

                                        <td>

                                            Rs. {{ $sale->subTotal }}/=
                                        </td>


                                    </tr>

                                @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="font-size: 20px"><strong>Total</strong></td>
                                    <td style="font-size: 18px;border-top: groove;border-bottom: double">
                                        Rs.{{$dailyTotal}}/=
                                    </td>

                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-sm-1">

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="submitted" class="col-md-4 control-label">Submitted By:</label>
                                        <br>
                                        .....................................
                                    </div>
                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="submitted" class="col-md-4 control-label">Reviewed By:</label>
                                        <br>
                                        ......................................
                                    </div>
                                </div>
                                <div class="col-sm-1">

                                </div>
                            </div>
                        </div>


                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-2">
                            <input style="margin-top: 8px;" class="btn btn-success" type="button"
                                   onclick="printDiv('splitForPrint')"
                                   value="Print Report"/><br>

                        </div>

                        <div class="col-sm-2">

                            <div class="btn-group pull-right" style=" padding: 10px;">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="glyphicon glyphicon-th-list"></span> Import Table As

                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="Import as">


                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'excel',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/xls.png" width="24px"> XLS</a>
                                        </li>
                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'doc',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/word.png" width="24px"> Word</a>
                                        </li>

                                        </li>


                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/pdf.png" width="24px"> PDF</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>



                @endif
            </div>

            <div class="row">
                @if(!empty($spares) )


                    <div id="content">
                        <div id="splitForPrint" style="border-style: solid">
                            <br>
                            <div class="row">
                                <div class="col-sm-3">


                                </div>
                                <div class="col-sm-6 text-center">
                                    <h2 style="display: inline" align="center"><strong>{{$reportHeading}}</strong></h2>

                                    <img src='/Images /{{$image}}' style=" width: 96px; height: 72px;" alt="">

                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">

                                </div>
                                <div class="col-sm-6   text-center">
                                    <h4 style="margin-left: 10px;margin-bottom: 0px;margin-top: 0px; ">Reporting
                                        Date:{{$reportDate}} </h4><br>


                                </div>
                                <div class="col-sm-3">
                                    {{--{{$address}}--}}
                                </div>
                            </div>


                            <table class="table table-bordered table-hover" id="reportingTable">

                                {{-- <tr>

                                      @foreach($categories as $category)

                                         <th>{{$category->categoryName}}</th>
                                     @endforeach



                                 </tr>--}}
                                <thead>
                                <tr>

                                    <th>Part Number</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Category</th>

                                    <th>year</th>
                                    <th>FuelType</th>
                                    <th>Transmission</th>
                                    <th>Quantity</th>


                                </tr>
                                </thead>

                                <tr>

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


                                    </tr>

                                @endforeach


                            </table>
                            <div class="row">
                                <div class="col-sm-1">

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="submitted" class="col-md-4 control-label">Submitted By:</label>
                                        <br>

                                    </div>
                                </div>
                                <div class="col-sm-4">;

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="submitted" class="col-md-4 control-label">Reviewed By:</label>
                                        <br>

                                    </div>
                                </div>
                                <div class="col-sm-1">

                                </div>
                            </div>
                        </div>


                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-2">
                            <input style="margin-top: 8px;" class="btn btn-success" type="button"
                                   onclick="printDiv('splitForPrint')"
                                   value="Print Report"/><br>

                        </div>
                        <div class="col-sm-2">

                            <div class="btn-group pull-right" style=" padding: 10px;">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="glyphicon glyphicon-th-list"></span> Import Table As

                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="Import as">


                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'excel',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/xls.png" width="24px"> XLS</a>
                                        </li>
                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'doc',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/word.png" width="24px"> Word</a>
                                        </li>

                                        </li>


                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/pdf.png" width="24px"> PDF</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>



                @endif
            </div>

            <div class="row">
                @if(empty($dailyTotal) && empty($spares) && empty($categories) )
                    <h4>No Data</h4>
                @endif
            </div>

            <div class="row">
                @if(!empty($dailyProfit) && empty($spares))


                    <div id="content">
                        <div id="splitForPrint" style="border-style: solid">
                            <br>
                            <div class="row">
                                <div class="col-sm-3">


                                </div>
                                <div class="col-sm-6 text-center">
                                    <h2 style="display: inline" align="center"><strong>{{$reportHeading}}</strong></h2>

                                    <img src='/Images /{{$image}}' style=" width: 96px; height: 72px;" alt="">

                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">

                                </div>
                                <div class="col-sm-6   text-center">
                                    <h4 style="margin-left: 10px;margin-bottom: 0px;margin-top: 0px; ">Reporting
                                        Period:</h4>
                                    @if(!empty($month))
                                        <h5 style="margin-left: 10px;"><strong>{{$month}}</strong></h5>
                                    @elseif(!empty($startDate))


                                        <h5 style="margin-left: 10px;"><strong>{{$reportDate}}</strong></h5>
                                        @endIf

                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>


                            <table class="table table-bordered table-hover" id="reportingTable">

                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Part No.</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Total Profit</th>
                                    <th>Total Cost</th>
                                    <th>Net Profit</th>
                                </tr>


                                </thead>
                                <tr>

                                @foreach($dailyProfit as $profit)

                                    <tr>
                                        <td>{{ $profit->order->orderDate }}
                                        </td>

                                        <td>{{ $profit->spare->partNumber }}
                                        </td>

                                        <td>
                                            {{ $profit->spare->description }}
                                        </td>
                                        <td>

                                            {{ $profit->quantity }}
                                        </td>
                                        <td>

                                            Rs. {{ $profit->subTotal }}/=
                                        </td>
                                        <td>
                                            Rs. {{ $profit->totalCost }}/=
                                        </td>

                                        <td>

                                            Rs. {{ $profit->subTotal - $profit->totalCost }}/=
                                        </td>


                                    </tr>

                                @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td style="font-size: 20px"><strong>Total</strong></td>
                                    <td style="font-size: 18px;border-top: groove;border-bottom: double">
                                        Rs.{{$dailyTotal}}/=
                                    </td>

                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-sm-1">

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="submitted" class="col-md-4 control-label">Submitted By:</label>
                                        <br>
                                        .....................................
                                    </div>
                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="submitted" class="col-md-4 control-label">Reviewed By:</label>
                                        <br>
                                        ......................................
                                    </div>
                                </div>
                                <div class="col-sm-1">

                                </div>
                            </div>
                        </div>


                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-2">
                            <input style="margin-top: 8px;" class="btn btn-success" type="button"
                                   onclick="printDiv('splitForPrint')"
                                   value="Print Report"/><br>

                        </div>

                        <div class="col-sm-2">

                            <div class="btn-group pull-right" style=" padding: 10px;">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="glyphicon glyphicon-th-list"></span> Import Table As

                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="Import as">


                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'excel',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/xls.png" width="24px"> XLS</a>
                                        </li>
                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'doc',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/word.png" width="24px"> Word</a>
                                        </li>

                                        </li>


                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/pdf.png" width="24px"> PDF</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>



                @endif
            </div>


            <div class="row">
                @if(!empty($dailyOrders) )


                    <div id="content">
                        <div id="splitForPrint" style="border-style: solid">
                            <br>
                            <div class="row">
                                <div class="col-sm-3">


                                </div>
                                <div class="col-sm-6 text-center">
                                    <h2 style="display: inline" align="center"><strong>{{$reportHeading}}</strong></h2>

                                    <img src='/Images /{{$image}}' style=" width: 96px; height: 72px;" alt="">

                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">

                                </div>
                                <div class="col-sm-6   text-center">
                                    <h4 style="margin-left: 10px;margin-bottom: 0px;margin-top: 0px; ">Reporting
                                        Date:</h4>
                                    @if(!empty($month))
                                        <h5 style="margin-left: 10px;"><strong>{{$month}}</strong></h5>
                                    @elseif(!empty($reportDate))


                                        <h5 style="margin-left: 10px;"><strong>{{$reportDate}}</strong></h5>
                                        @endIf

                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>


                            <table class="table table-bordered table-hover" id="reportingTable">



                                @foreach($dailyOrders as $order)

                                     <tr>
                                        <td><strong>Order ID: </strong> {{ $order->id }}
                                        </td>
                                        <td><strong>Date: </strong>{{ $order->orderDate }}
                                        </td>
                                        <td>

                                           <strong>Customer name: </strong> {{ $order->user->name }}
                                        </td>

                                        <td>
                                            <strong>Order Address: </strong>{{ $order->shippingAddress}}
                                        </td>


                                    </tr>
                                    <tr>
                                        <td  colspan="4" style="font-family: 'Adobe Arabic'; font-size: 25px; background-color: darkgray  " ><strong>Items
                                                In the Order-:</strong></td>
                                     </tr>


                                        <th>Spare Id</th>
                                        <th>Spare Name</th>
                                        <th>Quantity</th>
                                        <th>Status</th>

                                    </tr>
                                    @foreach($dailySales as $dailySale)
                                        @if($dailySale->order_id==$order->id)
                                            <tr>
                                                <td>{{$dailySale->spare->id}}</td>
                                                <td>{{$dailySale->spare->description}}</td>

                                                <td>{{$dailySale->quantity}}</td>
                                                <td>{{$dailySale->orderStatus}}</td>
                                            </tr>



                                        @endif
                                    @endforeach
<tr><td colspan="4" style="background-color: lightyellow"></td></tr>
                                @endforeach

                                <tr>
                                    <td></td>

                                    <td></td>
                                    <td style="font-size: 20px"><strong> </strong></td>
                                    <td>
                                        {{--Rs.{{$dailyTotal}}/=--}}
                                    </td>

                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-sm-1">

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="submitted" class="col-md-4 control-label">Submitted By:</label>
                                        <br>
                                        .....................................
                                    </div>
                                </div>
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="submitted" class="col-md-4 control-label">Reviewed By:</label>
                                        <br>
                                        ......................................
                                    </div>
                                </div>
                                <div class="col-sm-1">

                                </div>
                            </div>
                        </div>


                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-2">
                            <input style="margin-top: 8px;" class="btn btn-success" type="button"
                                   onclick="printDiv('splitForPrint')"
                                   value="Print Report"/><br>

                        </div>

                        <div class="col-sm-2">

                            <div class="btn-group pull-right" style=" padding: 10px;">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="glyphicon glyphicon-th-list"></span> Import Table As

                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="Import as">


                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'excel',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/xls.png" width="24px"> XLS</a>
                                        </li>
                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'doc',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/word.png" width="24px"> Word</a>
                                        </li>

                                        </li>


                                        <li><a href="#"
                                               onclick="$('#splitForPrint').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">
                                                <img src="/Retailer/Libraries/rimages/pdf.png" width="24px"> PDF</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>



                @endif
            </div>


        </div>
    </div>

@endsection