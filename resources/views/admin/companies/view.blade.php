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
                  <h4 class="page-title float-left">COMPANIES</h4>
                   <ol class="breadcrumb float-right">
                    @if (Auth::guard('admin')->user()->can('company-create'))
                    <a href="{{ url('admin/companies/add') }}"><button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" >Add New Company</button></a>
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
                          <th width="20%">Company Name</th>
                          <th width="10%">Email</th>
                          <th width="5%">Domain</th>
                          <th width="10%">Created At</th>
                          @if (Auth::guard('admin')->user()->canany(['company-edit', 'company-delete']))
                          <th width="10%">Action</th>
                          @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($companies as $company)
                        <tr>
                          <td>{{ $company->owner_name }}</td>
                          <td>{{ $company->name }}</td>
                          <td>{{ $company->email }}</td>
                          <td>{{ $company->domain }}</td>
                          <td>                                
                            {{ date('d M Y, h:i A',strtotime($company->created_at)) }}
                          </td>
                          @if (Auth::guard('admin')->user()->canany(['company-edit', 'company-delete']))
                          <td>
                            @if (Auth::guard('admin')->user()->can('company-edit'))
                            <a href="{{ url('admin/companies/edit', $company->id) }}"><button  class="btn btn-success btn-sm btn-rounded waves-light waves-effect"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                            @endif
                            @if (Auth::guard('admin')->user()->can('company-delete'))
                             <button class="btn btn-success btn-sm btn-rounded waves-light waves-effect" onclick="del('{{$company->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
    
     <div class="modal fade" id="delete-company" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">DELETE COMPANY</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <div class="modal-body">
                  <p>Are you sure to delete this company?</p>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                  <form class="form-horizontal" action="{{ url('admin/companies/delete') }}" method="get">
                      <input type="hidden" name="company_id" id="company_id">
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
      function del(company_id)
        {
            $('#company_id').val(company_id);
            $('#delete-company').modal('show');
        }
    
  </script>
</html>
