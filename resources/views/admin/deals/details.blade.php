<!DOCTYPE html>
<html lang="en">
<head>
    @include("admin.partials.header") 
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
                                            <li class="breadcrumb-item active">Deals</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Deal Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <!-- end row -->
                        <div class="row">
                            <div class="col-lg-6">
                                @if($deal->status=='2')
                                <p> 
                                    <button class="btn btn-success" type="button" disabled>
                                        Won</button>
                                </p>        
                                @elseif($deal->status=='3')
                                <p>
                                    <button class="btn btn-danger" type="button" disabled>
                                        Lost</button>
                                 </p>       
                                @else
                                    <p>
                                    <button class="btn btn-success btn-sm btn-rounded waves-light waves-effect" onclick="won('{{$deal->id}}')">Won</button>
                                    <button class="btn btn-danger btn-sm btn-rounded waves-light waves-effect" onclick="lost('{{$deal->id}}')">Lost</button>
                                    </p>
                                @endif        
                              
                                <div class="card card-body">
                                    <h5>
                                    <span style="color:blue;"><b>{{$deal->name}} </b></span><br><br>
                                    {{$deal->pipeline}} -> 
                                    {{$deal->stage_name}}</h5>
                                    <i>Amount: <b>BHD {{$deal->amount}}</b></i>
                                    <i>Expected Close Date : <b>{{date('d-M-Y',strtotime($deal->expected_close_date))}}</b></i>
                                    <i>Created by: {{$deal->user_name}}</i>
                                    <i>Created on: {{date('d-M-Y',strtotime($deal->created_at))}}</i>
                                </div>

                                <div class="card card-body">
                                    <h5>Contacts</h5>
                                    @foreach($deal_contacts as $contact)
                                    <i>{{$contact->first_name.' '.$contact->last_name}}</i>
                                    @endforeach
                                </div>
                                <div class="card card-body">
                                    <h5>Companies</h5>
                                    @foreach($deal_contacts as $contact)
                                    <i>{{$contact->company_name}}</i>
                                    <i>{{$contact->company_domain}}</i>
                                    @endforeach
                                </div>
                             
                                <div class="card card-body">
                                    <h5>Deal Product</h5>
                                    @foreach($deal_products as $product)
                                    <i>Product Name <b>: {{$product->name}}</b></i>
                                    <i>Unit Price <b>: BHD {{$product->unit_price}}</b></i>
                                    <i>Quantity <b>: {{$product->quantity}}</b></i>
                                    <i>Total <b>: BHD {{$product->total}}</b></i>
                                    @endforeach
                                </div>
                            </div>
                        </div> <!-- end row -->
                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->
                <!-- Footer Start -->
                   @include("admin.partials.footer")
                </footer>
                <!-- end Footer -->
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <div class="modal fade" id="won-deal" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">WON DEAL</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <div class="modal-body">
                  <p>Are you sure to make this won?</p>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                  <form class="form-horizontal" action="{{ url('admin/deals/won') }}" method="get">
                      <input type="hidden" name="won_id" id="won_id">
                     <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Submit</button>
                  </form>
               </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="lost-deal" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">LOST DEAL</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <form class="form-horizontal" action="{{ url('admin/deals/lost') }}" method="get">
               <div class="modal-body">
                  <input type="hidden" name="lost_id" id="lost_id">
                  <input type="text" class="form-control" name="lost_reason" placeholder="Lost reason" required>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>                 
                      
                     <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Submit</button>
                  </form>
               </div>
            </div>
          </div>
        </div>

        @include("admin.partials.scripts")
    </body>
    <script>
        function won(deal_id)
        {
            $('#won_id').val(deal_id);
            $('#won-deal').modal('show');
        }
        function lost(deal_id)
        {
            $('#lost_id').val(deal_id);
            $('#lost-deal').modal('show');
        }
  </script>
</html>