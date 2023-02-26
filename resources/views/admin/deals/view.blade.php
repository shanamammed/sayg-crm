<!DOCTYPE html>
<html>
  <head>
    @include("admin.partials.header")
    @include("admin.partials.table-css")
  </head>
  <body>
    <div id="wrapper">
      @include("admin.partials.sidebar")
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="page-title-box">
                  <h4 class="page-title float-left">DEALS</h4>
                   <ol class="breadcrumb float-right">
                    @if (Auth::guard('admin')->user()->can('deal-create'))
                    <a href="{{ url('admin/deals/add') }}"><button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" >Add New Deal</button></a>
                    @endif
                  </ol>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th width="10%">Owner</th>
                          <th width="15%">Deal Name</th>
                          <th width="10%">Stage</th>
                          <th width="5%">Amount</th>
                          <th width="15%">Expected Close Date</th>
                          <th width="15%">Companies</th>
                          <th width="10%">Status</th>
                          @if (Auth::guard('admin')->user()->canany(['deal-edit', 'deal-delete']))
                          <th width="10%">Action</th>
                          @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($deals as $deal)
                        <tr>
                          <td>{{ $deal->owner_name }}</td>
                          <td>{{ $deal->name }}</td>
                          <td>{{ $deal->stage }}</td>
                          <td>BHD {{ $deal->amount }}</td>
                          <td>                                
                            {{ date('d M Y',strtotime($deal->expected_close_date)) }}
                          </td>
                          <td>@foreach($deal->companies as $company)
                                {{ $company->company_name }}<br>
                              @endforeach
                          </td>
                          <td>{{ $deal->status  ? 'Open' : 'Closed' }}</td>
                          @if (Auth::guard('admin')->user()->canany(['deal-edit', 'deal-delete']))
                          <td>
                            @if (Auth::guard('admin')->user()->can('deal-edit'))
                            <a href="{{ url('admin/deals/edit', $deal->id) }}"><button  class="btn btn-success btn-sm btn-rounded waves-light waves-effect"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                            @endif
                            @if (Auth::guard('admin')->user()->can('deal-delete'))
                             <button class="btn btn-success btn-sm btn-rounded waves-light waves-effect" onclick="del('{{$deal->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                            @endif 
                          </td>
                          @endif
                        </tr>
                      @endforeach 
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
        
      </div>
      @include("admin.partials.footer")
    </div>
    
     <div class="modal fade" id="delete-deal" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">DELETE DEAL</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <div class="modal-body">
                  <p>Are you sure to delete this deal?</p>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                  <form class="form-horizontal" action="{{ url('admin/deals/delete') }}" method="get">
                      <input type="hidden" name="deal_id" id="deal_id">
                     <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Delete</button>
                  </form>
               </div>
            </div>
          </div>
        </div>

  </body>
  @include("admin.partials.scripts")
  @include("admin.partials.table-scripts")
  <!-- <script type="text/javascript">
    $('#datatable').DataTable({
           "ordering": false
           });
  </script>  -->
  <script>
      function del(deal_id)
        {
            $('#deal_id').val(deal_id);
            $('#delete-deal').modal('show');
        }
    
  </script>
</html>
