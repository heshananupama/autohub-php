@extends('Retailer/index')

@section('content')

    {{--<style>--}}

    {{--#reportingTable {--}}
    {{--background: #f5f5f5;--}}
    {{--border-collapse: separate;--}}
    {{--box-shadow: inset 0 1px 0 #fff;--}}
    {{--font-size: 12px;--}}
    {{--line-height: 24px;--}}
    {{--margin: 30px auto;--}}
    {{--text-align: left;--}}
    {{--width: 99%;--}}
    {{--}--}}

    {{--#reportingTable th {--}}
    {{--text-align: center;--}}
    {{--background: linear-gradient(#777, #444);--}}
    {{--border-left: 1px solid #555;--}}
    {{--border-right: 1px solid #777;--}}
    {{--border-top: 1px solid #555;--}}
    {{--border-bottom: 1px solid #333;--}}
    {{--box-shadow: inset 0 1px 0 #999;--}}
    {{--color: #fff;--}}
    {{--font-family: Calibri;--}}
    {{--font-size: 16px;--}}
    {{--font-weight: bold;--}}
    {{--padding: 10px 15px;--}}
    {{--position: relative;--}}
    {{--text-shadow: 0 1px 0 #000;--}}
    {{--}--}}

    {{--#reportingTable th:after {--}}
    {{--background: linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, .08));--}}
    {{--content: '';--}}
    {{--display: block;--}}
    {{--height: 25%;--}}
    {{--left: 0;--}}
    {{--margin: 1px 0 0 0;--}}
    {{--position: absolute;--}}
    {{--top: 25%;--}}
    {{--width: 100%;--}}
    {{--}--}}

    {{--#reportingTable th:first-child {--}}
    {{--border-left: 1px solid #777;--}}
    {{--box-shadow: inset 1px 1px 0 #999;--}}
    {{--}--}}

    {{--#reportingTable th:last-child {--}}
    {{--box-shadow: inset -1px 1px 0 #999;--}}
    {{--}--}}

    {{--#reportingTable td {--}}
    {{--font-family: Calibri;--}}
    {{--font-size: 14px;--}}

    {{--border-right: 1px solid #fff;--}}
    {{--border-left: 1px solid #e8e8e8;--}}
    {{--border-top: 1px solid #fff;--}}
    {{--border-bottom: 1px solid #e8e8e8;--}}
    {{--padding: 10px 15px;--}}
    {{--position: relative;--}}
    {{--transition: all 300ms;--}}
    {{--}--}}

    {{--#reportingTable td:first-child {--}}
    {{--box-shadow: inset 1px 0 0 #fff;--}}
    {{--}--}}

    {{--#reportingTable td:last-child {--}}
    {{--border-right: 1px solid #e8e8e8;--}}
    {{--box-shadow: inset -1px 0 0 #fff;--}}
    {{--}--}}

    {{--/* tr:last-of-type td {--}}
    {{--box-shadow: inset 0 -1px 0 #fff;--}}
    {{--}--}}

    {{--tr:last-of-type td:first-child {--}}
    {{--box-shadow: inset 1px -1px 0 #fff;--}}
    {{--}--}}

    {{--tr:last-of-type td:last-child {--}}
    {{--box-shadow: inset -1px -1px 0 #fff;--}}
    {{--}--}}

    {{--tbody:hover td {--}}
    {{--color: transparent;--}}
    {{--text-shadow: 0 0 3px #aaa;--}}
    {{--}--}}

    {{--tbody:hover tr:hover td {--}}
    {{--color: #444;--}}
    {{--text-shadow: 0 1px 0 #fff;--}}
    {{--} */--}}
    {{--</style>--}}

    {{--  <div id="editor"></div>
      <button id="cmd">generate PDF</button>
      <script type="text/javascript">
          var doc = new jsPDF('p', 'pt');
          var specialElementHandlers = {
              '#editor': function (element, renderer) {
                  return true;
              }
          };

          $('#cmd').click(function () {
              console.log("Hola");
              doc.fromHTML($('#content').html(), 15, 15, {
                  'width': 170,
                  'elementHandlers': specialElementHandlers
              });
              doc.save('sample-file.pdf');
          });
      </script>
  --}}
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <form action="{{url('/retailer/generateReports')}}"
                      method="post"> {{ csrf_field() }}
                    <h2><strong>Report Generation </strong></h2><br><br>

                    <div class="col-sm-3">
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
                    <div class="col-sm-3" id="reportingPeriodDropDown">
                        <div class="form-group">
                            <label for="SortBy" class="control-label">
                                Reporting Period</label>

                            <select id="reportFrequency" name="frequency" type="text"
                                    class="form-control" onchange="activateReportDateSelect(this.value)">
                                <option value="">Select a Time Frequency</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>

                            </select>
                        </div>
                    </div>
                    <div id="dateInput" style="visibility: hidden" class="col-sm-2">
                        <label for="SortBy" class="control-label">
                            Input Date</label>
                        <input placeholder="pick a date" name="oneDate" class="form-control" type="text" id="date" value=""/>


                    </div>
                    <div id="monthInput"  class="col-sm-2"  style="visibility: hidden">

                        <label for="SortBy" class="control-label">
                           </label>
                        <input placeholder="pick a Month"  class="form-control" name="monthSelect" id="monthPicker" type="text">



                    </div>

                    <div class="col-sm-2">
                        <input type="submit" class="btn btn-success" style="margin-top: 25px;" value="Generate Report">

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
                                <h5 style="margin-left: 10px;"><strong>{{$reportStartDate}}
                                        to {{$reportEndDate}}</strong></h5><br>

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

                                <th>Date / Categories</th>
                                @foreach($categories as $category)

                                    <th>{{$category->categoryName}}</th>
                                @endforeach


                                <th>Sub Total</th>
                            </tr>
                            </thead>

                            <tr>

                            @foreach($reportData as $date => $array)

                                <tr class="page-break">

                                    <td style="width: 25px;">{{ $date }}
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
                        <input style="margin-top: 8px;" class="btn btn-success" type="button" onclick="printDiv('splitForPrint')"
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
                @if(!empty($dailyTotal) && empty($spares))


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
                                    <td>Part No.</td>
                                    <td>Description</td>
                                    <td>Quantity</td>
                                    <td>Item Status</td>
                                    <td>Sub Total</td>
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
                            <input style="margin-top: 8px;" class="btn btn-success" type="button" onclick="printDiv('splitForPrint')"
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
                            <input style="margin-top: 8px;" class="btn btn-success" type="button" onclick="printDiv('splitForPrint')"
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
            </div>

            <div class="row">
                @if(empty($dailyTotal) && empty($spares) && empty($categories) )
                    <h4>No Data</h4>
                    @endif
            </div>




    </div>
    </div>

@endsection