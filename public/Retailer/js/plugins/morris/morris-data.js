// Morris.js Charts sample data for SB Admin template

$(function() {
    $.ajax({
        type: 'get',
        url: ('/retailer/chartSales'),


        success: function (data) {
            var chartData=[];
            for(var k=0;k<data.Date.length;k++){
                chartData.push({ d:data.Date[k],sales:data.value[k]});
            }
            console.log(chartData);
            Morris.Area({
                element: 'morris-area-chart',
                data: chartData,
                // The name of the data record attribute that contains x-visitss.
                xkey: 'd',
                // A list of names of data record attributes that contain y-visitss.
                ykeys: ['sales'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['sales'],
                // Disables line smoothing
                smooth: false,
                parseTime:false,

                resize: true
            });


        }

    });

    $.ajax({
        type: 'get',
        url: ('/retailer/loadStrategicSalesChart'),


        success: function (data) {
            var chartData=[];

            for (var key in data) {
                var obj = data[key];

                chartData.push({m:key,suspension:obj['Suspension'],transmission:obj['Transmission'],body:obj['Body'],
                    lights:obj['Lights'],engine:obj['Engine']


                });


            }


            console.log(chartData);
            Morris.Bar({
                element: 'morris-area-chart2',
                data: chartData,
                // The name of the data record attribute that contains x-visitss.
                xkey: 'm',
                // A list of names of data record attributes that contain y-visitss.
                ykeys: ['suspension','transmission','body','lights','engine'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['suspension','transmission','body','electrical','engine'] ,
                // Disables line smoothing
                smooth: false,
                parseTime:false,

                resize: true
            });



        }

    });
    $.ajax({
        type: 'get',
        url: ('/retailer/loadStrategicBrandsChart'),


        success: function (data) {
            var chartData=[];

            for (var key in data) {
                var obj = data[key];

                chartData.push({m:key,Honda:obj['Honda'],
                    Toyota:obj['Toyota'], Mitsubishi:obj['Mitsubishi'], Nissan:obj['Nissan'],
                    Suzuki:obj['Suzuki']


                });


            }


            console.log(chartData);
            Morris.Line({
                element: 'morris-area-chart3',
                data: chartData,
                // The name of the data record attribute that contains x-visitss.
                xkey: 'm',
                // A list of names of data record attributes that contain y-visitss.
                ykeys: ['Honda','Toyota','Mitsubishi','Nissan','Suzuki'],

                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Honda','Toyota','Mitsubishi','Nissan','Suzuki'],
                // Disables line smoothing
                smooth: false,
                parseTime:false,

                resize: true
            });



        }

    });

    $.ajax({
        type: 'get',
        url: ('/retailer/loadOverviewRevenue'),


        success: function (data) {
            var chartData=[];

            for (var key in data) {
                var obj = data[key];

                chartData.push({m:key,
                    TotalSales:obj['subTotal'], TotalCost:obj['totalCost'], TotalRevenue:obj['totalProfit']

                });


            }


            console.log(chartData);
            Morris.Bar({
                element: 'morris-area-chart4',
                data: chartData,
                // The name of the data record attribute that contains x-visitss.
                xkey: 'm',
                // A list of names of data record attributes that contain y-visitss.
                ykeys: ['TotalSales','TotalCost','TotalRevenue'],

                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['TotalSales','TotalCost','TotalRevenue'],
                // Disables line smoothing
                smooth: false,
                parseTime:false,

                resize: true
            });



        }

    });



    $.ajax({
        type: 'get',
        url: ('/retailer/chartProfits'),


        success: function (data) {
            var chartData=[];
            for(var k=0;k<data.Date.length;k++){
                chartData.push({ d:data.Date[k],profits:data.value[k]});
            }
            console.log(chartData);
            Morris.Line({
                element: 'morris-line-chart',
                data: chartData,
                // The name of the data record attribute that contains x-visitss.
                xkey: 'd',
                // A list of names of data record attributes that contain y-visitss.
                ykeys: ['profits'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['profits'],
                // Disables line smoothing
                smooth: false,
                parseTime:false,

                resize: true
            });



        }

    });

    // Area Chart

    $.ajax({
        type: 'get',
        url: ('/retailer/chartOrders'),


        success: function (data) {
            var chartData=[];
            for(var k=0;k<data.Date.length;k++){
                chartData.push({ d:data.Date[k],orders:data.value[k]});
            }
            console.log(chartData);
            Morris.Bar({
                element: 'morris-bar-chart',
                data: chartData,
                // The name of the data record attribute that contains x-visitss.
                xkey: 'd',
                // A list of names of data record attributes that contain y-visitss.
                ykeys: ['orders'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['orders'],
                // Disables line smoothing
                smooth: false,
                parseTime:false,
                resize: true
            });



        }

    });



    $.ajax({
        type: 'get',
        url: ('/retailer/chartDonuts'),


        success: function (data) {
            var label=[];
            label=["Shipped","Purchased","Delivered"];

            var chartData=[];
            for(var k=0;k<data.length;k++){
                chartData.push({ label:label[k],value:data[k]})
            }
            Morris.Donut({
                element: 'morris-donut-chart',
                data: chartData,
                resize: true
            });




        }

    });






});
