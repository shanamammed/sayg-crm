<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/abstack/layouts/blue/calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Feb 2023 10:50:09 GMT -->
<head>
        <meta charset="utf-8" />
        <title>CRM - SayG</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Plugin css -->
        <link href="{{ asset('/libs/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Abstack</a></li>
                                            <li class="breadcrumb-item active">Calendar</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Calendar</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-lg-12">

                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="#" class="btn btn-lg btn-gradient btn-block waves-effect waves-light">
                                             New Deals
                                            </a>
                                            @foreach($recent_deals as $deal)
                                            <div id="external-events">
                                                <div class="external-event bg-light" data-class="bg-light">
                                                    <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle" style="color: black;"></i><span style="color: black;">{{ $deal->name }}<br>
                                                        {{ $deal->stage_name }}<br>
                                                        {{ date('d-M-Y',strtotime($deal->created_at)) }} - {{ date('d-M-Y',strtotime($deal->expected_close_date)) }}
                                                        
                                                    </span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div> <!-- end col-->
                                        <div class="col-md-9">
                                            <!-- <div id="calendar"></div> -->
                                            <div id='calendar'></div>
                                        </div> <!-- end col -->
                                    </div>  <!-- end row -->
                                </div>

                               
                                <!-- Modal Add Category -->
                                <div class="modal fade none-border" id="add-category" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Add a category</h4>
                                            </div>
                                            <div class="modal-body p-3">
                                                <form role="form">
                                                    <div class="form-group">
                                                        <label class="control-label">Category Name</label>
                                                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Choose Category Color</label>
                                                        <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                                            <option value="success">Success</option>
                                                            <option value="danger">Danger</option>
                                                            <option value="info">Info</option>
                                                            <option value="pink">Pink</option>
                                                            <option value="primary">Primary</option>
                                                            <option value="warning">Warning</option>
                                                            <option value="inverse">Inverse</option>
                                                        </select>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL -->
                            </div>
                            <!-- end col-12 -->
                        </div> <!-- end row -->

                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->

                <!-- Footer Start -->
                @include("admin.partials.footer")
                <!-- end Footer -->

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

         <!-- plugin js -->
         <script src="{{ asset('/libs/moment/moment.min.js') }}"></script>
         <script src="{{ asset('/libs/jquery-ui/jquery-ui.min.js') }}"></script>
         <!-- <script src="{{ asset('/libs/fullcalendar/fullcalendar.min.js') }}"></script> -->
 
         <!-- Calendar init -->
         <script src="{{ asset('/js/pages/calendar.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('/js/app.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            $(document).ready(function() {
                // page is now ready, initialize the calendar...
                $('#calendar').fullCalendar({
                    // put your options and callbacks here
                    // defaultView: 'agendaWeek',
                    events : [
                        @foreach($appointments as $appointment)
                        {
                            title : '{{ $appointment->name.' - '.$appointment->stage_name}}',
                            start : '{{ $appointment->created_date }}',
                            
                            end: '{{ $appointment->expected_close_date }}',
                          
                        },
                        @endforeach
                    ],

                });
            });
       </script>
    </body>
</html>