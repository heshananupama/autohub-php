@extends('Retailer/index')

@section('content')
    <div id="page-wrapper">
        <h1 style="margin-left: 20px;"><strong>Analytical Charts</strong></h1><br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Sales Chart By Categories</h3>
                        </div>
                        <div class="panel-body">
                            <div id="morris-area-chart2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-dollar fa-fw"></i> Profits Chart By Vehicle Brands</h3>
                        </div>
                        <div class="panel-body">
                            <div id="morris-area-chart3"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-dollar fa-fw"></i> Revenue Overview</h3>
                        </div>
                        <div class="panel-body">
                            <div id="morris-area-chart4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
    </script>
            @endsection