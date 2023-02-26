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
        <script type="text/javascript" src="{{asset('assets/js/echarts.min.js')}}"></script>    
    </head>

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
                                        <h4 class="header-title">Deals By Stages ({{ date('Y') }}) </h4>
    
                                        <canvas id="myChart"></canvas>
    
                                    </div>
                                </div>
    
                            </div>
                            <!-- end row -->
                            <div>
                                <div class="col-lg-6">  
                                    <div class="card-box">
                                        <h4 class="header-title">Deals ({{ date('Y') }})</h4>   
                                         <canvas id="pieChart"></canvas>    
                                    </div>
                                </div> 
                            </div>

                           <div class="row">  
                                <div class="col-lg-6">
                                    <div class="card-box">
                                        <h4 class="header-title">Contacts</h4>
    
                                        <canvas id="lineChart" class="mt-4"></canvas>
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
         <!-- <script src="{{ asset('/js/pages/chartjs.init.js') }}"> -->
            
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
            'Total',
            'Won',
            'Lost'
          ],
          datasets: [{
            label: 'My First Dataset',
            data: [{{$total_deals}}, {{$won_deals}}, {{$lost_deals}}],
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
            label: 'My First Dataset',
            data: contacts,
            borderColor: 'rgb(255, 99, 132)',
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
    </body>
</html>