<!DOCTYPE html>
<html>
  <head>

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
                  <h4 class="page-title float-left">ROLES</h4>
                   <ol class="breadcrumb float-right">
                    @if (Auth::guard('admin')->user()->can('role-create'))   
                    <a href="{{ url('admin/roles/add') }}"><button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" >Add New Role</button></a>
                    @endif
                  </ol>
                  <div class="clearfix">
                    @if(Session::has('success'))
                     <div class="alert">
                      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                      <strong>Success!</strong> {{Session::get('success')}}
                    </div>
                      @endif
                  </div>
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
                          <th width="30%">Role Name</th>
                          @if (Auth::guard('admin')->user()->canany(['role-edit', 'role-delete']))
                          <th width="5%">Actions</th>
                          @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($roles as $role)
                        <tr>
                          <td>{{ $role->name }}</td>
                          @if (Auth::guard('admin')->user()->canany(['role-edit', 'role-delete']))
                          <td>
                           @if (Auth::guard('admin')->user()->can('role-edit')) 
                            <a href="{{ url('admin/roles/edit', $role->id) }}"><button class="btn btn-primary btn-sm btn-rounded waves-light waves-effect"><i class="fas fa-edit" aria-hidden="true"></i></button></a>
                           @endif 
                           @if (Auth::guard('admin')->user()->can('role-delete'))
                           <button class="btn btn-primary btn-sm btn-rounded waves-light waves-effect" onclick="del('{{$role->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
    
     <div class="modal fade" id="delete-role" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">DELETE ROLE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <div class="modal-body">
                  <p>Are you sure to delete this role?</p>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                  <form class="form-horizontal" action="{{ url('admin/roles/delete') }}" method="get">
                      <input type="hidden" name="role_id" id="role_id">
                     <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Delete</button>
                  </form>
               </div>
            </div>
          </div>
        </div>

  </body>

  @include("admin.partials.table-scripts")
  <!-- <script type="text/javascript">
    $('#datatable').DataTable({
           "ordering": false
           });
  </script>  -->
  <script>
      function del(role_id)
        {
            $('#role_id').val(role_id);
            $('#delete-role').modal('show');
        }
    
  </script>
</html>
