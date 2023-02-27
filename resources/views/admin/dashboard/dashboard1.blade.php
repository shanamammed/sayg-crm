<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>CRM - SayG</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App css -->
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!--         <script type="text/javascript" src="{{asset('assets/js/echarts.min.js')}}"></script>    
 -->    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">
             @include("admin.partials.sidebar")
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">SayG</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card-box">
                                        <h4 class="header-title"><h4 class="header-title">Deals By Stages ({{ date('Y') }}) </h4></h4>
    
                                        <canvas id="bar" height="350" class="mt-4"></canvas>
                                    </div>
                                </div>
    
                               
                            </div>
                            <div class="row">
                            <!--     <div class="col-lg-6">
                                    <div class="card-box">
                                        <h4 class="header-title">Deals By Stages ({{ date('Y') }}) </h4>
    
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div> -->
                               
                                <div class="col-lg-6">
                                    <div class="card-box">
                                        <h4 class="header-title mb-3">Recent added deals</h4>    
                                        <div class="inbox-widget slimscroll" style="max-height: 370px;">
                                            @foreach($recent_deals as $rec)
                                            <a href="#">
                                                <div class="inbox-item">
                                                    <p class="inbox-item-author">{{$rec->name}}</p>
                                                    <p class="inbox-item-text">{{$rec->stage_name}}</p>
                                                    <p class="inbox-item-date">{{ date('d-M-Y',strtotime($rec->created_at)) }} - {{ date('d-M-Y',strtotime($rec->expected_close_date)) }}</p>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card-box">
                                        <h4 class="header-title mb-3">Deals added by sales agents</h4>    
                                        <div class="inbox-widget slimscroll" style="max-height: 370px;">
                                            <table  class="table mb-0">
                                                <thead class="thread-light">
                                                    <th>Agent Name</th>
                                                    <th>Total Deals</th>
                                                    <th>Total Amount</th>
                                                </thead>
                                                <tbody>
                                                    @if(count($expiring_deals)>0)
                                                    @foreach($agents as $agent)
                                                    <tr>
                                                        <td>{{$agent->user_name}}</td>
                                                        <td>{{$agent->deals}}</td>
                                                        <td>{{$agent->total}}</td>
                                                    </tr>
                                                    @endforeach 
                                                    @else
                                                    <tr>
                                                       <td style="text-align:center;" colspan="4">No data found</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                          
                                        </div>
    
                                    </div>
                                </div>
                                <div class="col-lg-6">  
                                    <div class="card-box">
                                        <h4 class="header-title">Deals ({{ date('Y') }})</h4>   
                                         <!-- <canvas id="pieChart"></canvas>  --> 
                                         <canvas id="pie" height="300" class="mt-4"></canvas>  
                                    </div>
                                </div> 
                            </div>

                           <div class="row">  
                                <div class="col-lg-6">
                                    <!-- <div class="card-box">
                                        <h4 class="header-title">Contacts ({{date('d-M-Y',strtotime($weekStartDate))}} - {{date('d-M-Y',strtotime($weekEndDate))}}</h4>
    
                                        <canvas id="lineChart" class="mt-4"></canvas>
                                    </div> -->
                                     
                                        <div class="card-box">
                                            <h4 class="header-title">({{date('d-M-Y',strtotime($weekStartDate))}} - {{date('d-M-Y',strtotime($weekEndDate))}}</h4>
        
                                            <canvas id="lineChart" height="300" class="mt-4"></canvas>
                                        </div>
                                   
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-box">
                                        <h4 class="header-title mb-3">Recently expiring deals</h4>    
                                        <div class="inbox-widget slimscroll" style="max-height: 370px;">
                                            @if(count($expiring_deals)>0) 
                                            @foreach($expiring_deals as $exp)
                                            <a href="#">
                                                <div class="inbox-item">
                                                    <p class="inbox-item-author">{{$exp->name}}</p>
                                                    <p class="inbox-item-text">{{$exp->stage_name}}</p>
                                                    <p class="inbox-item-date">{{ date('d-M-Y',strtotime($exp->created_at)) }} - {{ date('d-M-Y',strtotime($exp->expected_close_date)) }}</p>
                                                </div>
                                            </a>
                                            @endforeach
                                            @else
                                            <div class="inbox-item">
                                            No data found
                                            </div>
                                            @endif
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
     
                            <!-- end row -->
    
                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->

                 @include("admin.partials.footer")
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

       

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{ asset('/js/vendor.min.js') }}"></script>

         <!-- Chart JS -->
         <script src="{{ asset('/libs/chart-js/Chart.bundle.min.js') }}"></script>
         <script src="{{ asset('/js/pages/chartjs.init.js') }}">
            
         </script>

        <!-- App js -->
        <script src="{{ asset('/js/app.min.js') }}"></script>
        <script>
           const ctx = document.getElementById('myChart');
           var labels =  {{ Js::from($labels) }};
           var stages =  {{ Js::from($data) }};

          new Chart(ctx, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Deals',
                data: stages,
                backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 159, 64, 0.2)',
                      'rgba(255, 205, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(201, 203, 207, 0.2)'
                    ],
                borderColor: [
                      'rgb(255, 99, 132)',
                      'rgb(255, 159, 64)',
                      'rgb(255, 205, 86)',
                      'rgb(75, 192, 192)',
                      'rgb(54, 162, 235)',
                      'rgb(153, 102, 255)',
                      'rgb(201, 203, 207)'
                    ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });

           const config = {
                type: 'bar',
                data: data,
                options: {}
              };
          // === include 'setup' then 'config' above ===

          var myChart = new Chart(
            document.getElementById('myChart'),
            config
          );

        </script>

        <script type="text/javascript">

        const dataPie = {
          labels: [
            'Open',
            'Won',
            'Lost'
          ],
          datasets: [{
            label: 'My First Dataset',
            data: [{{$active_deals}}, {{$won_deals}}, {{$lost_deals}}],
            backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
          }]
        };

         const configPie = {
                type: 'pie',
                data: dataPie,
                options: {}
              };
        
        var pieChart = new Chart(
            document.getElementById('pieChart'),
            configPie
          );
       </script>
       <script type="text/javascript">
        var linelabels =  {{ Js::from($line_labels) }};
        var contacts =  {{ Js::from($line_data) }};
        const dataLine = {
          labels:linelabels,
          datasets: [{
            label: 'Contacts',
            data: contacts,
            borderColor: 'rgb(255, 99, 132)',
            fill: false,
            tension: 0.1
          }]
        };

         const configLine = {
                type: 'line',
                data: dataLine,
                options: {}
              };
        
        var lineChart = new Chart(
            document.getElementById('lineChart'),
            configLine
          );
</script>

<script>
! function(s) {
    "use strict";
    var r = function() {};
    r.prototype.respChart = function(r, o, e, a) {
        var t = r.get(0).getContext("2d"),
            n = s(r).parent();

        function i() {
            r.attr("width", s(n).width());
            switch (o) {
                case "Line":
                    new Chart(t, {
                        type: "line",
                        data: e,
                        options: a
                    });
                    break;
                case "Doughnut":
                    new Chart(t, {
                        type: "doughnut",
                        data: e,
                        options: a
                    });
                    break;
                case "Pie":
                    new Chart(t, {
                        type: "pie",
                        data: e,
                        options: a
                    });
                    break;
                case "Bar":
                    new Chart(t, {
                        type: "bar",
                        data: e,
                        options: a
                    });
                    break;
                case "Radar":
                    new Chart(t, {
                        type: "radar",
                        data: e,
                        options: a
                    });
                    break;
                case "PolarArea":
                    new Chart(t, {
                        data: e,
                        type: "polarArea",
                        options: a
                    })
            }
        }
        s(window).resize(i), i()
            }, r.prototype.init = function() {
             var labels =  {{ Js::from($labels) }};
                   var stages =  {{ Js::from($data) }};

                this.respChart(s("#bar"), "Bar", {
                    labels: labels,
                    datasets: [{
                        label: "Deals",
                        backgroundColor: "rgba(60, 134, 216, 0.3)",
                        borderColor: "#3c86d8",
                        borderWidth: 2,
                        hoverBackgroundColor: "rgba(60, 134, 216, 0.7)",
                        hoverBorderColor: "#3c86d8",
                        data: stages
                    }]
                })

            this.respChart(s("#pie"), "Pie", {
            labels: ["Open", "Won", "Lost"],
            datasets: [{
                data: [{{$active_deals}}, {{$won_deals}}, {{$lost_deals}}],
                backgroundColor: ["#5d6dc3", "#3ec396", "#f9bc0b", "#4fbde9", "#313a46"],
                hoverBackgroundColor: ["#5d6dc3", "#3ec396", "#f9bc0b", "#4fbde9", "#313a46"],
                hoverBorderColor: "#fff"
            }]
        });
        
        var linelabels =  {{ Js::from($line_labels) }};
        var contacts =  {{ Js::from($line_data) }};
        this.respChart(s("#lineChart"), "Line", {
            labels: $linelabels,
            datasets: [{
                label: "Sales Analytics",
                fill: !1,
                lineTension: .05,
                backgroundColor: "#fff",
                borderColor: "#3ec396",
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0,
                borderJoinStyle: "miter",
                pointBorderColor: "#3ec396",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 8,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "#3ec396",
                pointHoverBorderWidth: 3,
                pointRadius: 1,
                pointHitRadius: 10,
                data: contacts
            }]
        }, {
            scales: {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 20,
                        stepSize: 10
                    }
                }]
            }
        });
            }, s.ChartJs = new r, s.ChartJs.Constructor = r
        }(window.jQuery),
        function(r) {
            "use strict";
            window.jQuery.ChartJs.init()
        }();
    </script>
    </body>
</html>