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
                  <h4 class="page-title float-left">USERS</h4>
                   <ol class="breadcrumb float-right">
                    @if (Auth::guard('admin')->user()->can('user-create'))
                    <a href="{{ url('admin/users/add') }}"><button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" >Add New User</button></a>
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
                          <th width="30%">User Name</th>
                          <th width="30%">Email</th>
                          <th width="5%">Status</th>
                          @if (Auth::guard('admin')->user()->canany(['user-edit', 'user-delete']))
                          <th width="10%">Action</th>
                          @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>                                
                            <div class="flex items-center justify-center {{ $user->active ? 'text-success' : 'text-danger' }}">
                              <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $user->active  ? 'Active' : 'Inactive' }}
                            </div>
                          </td>
                          @if (Auth::guard('admin')->user()->canany(['user-edit', 'user-delete']))
                          <td>
                            @if (Auth::guard('admin')->user()->can('user-edit'))
                            <a href="{{ url('admin/users/edit', $user->id) }}"><button  class="btn btn-success btn-sm btn-rounded waves-light waves-effect"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                            @endif
                            @if (Auth::guard('admin')->user()->can('user-delete'))
                             <button class="btn btn-success btn-sm btn-rounded waves-light waves-effect" onclick="del('{{$user->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
    
     <div class="modal fade" id="delete-user" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">DELETE USER</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <div class="modal-body">
                  <p>Are you sure to delete this user?</p>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                  <form class="form-horizontal" action="{{ url('admin/users/delete') }}" method="get">
                      <input type="hidden" name="user_id" id="user_id">
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
      function del(user_id)
        {
            $('#user_id').val(user_id);
            $('#delete-user').modal('show');
        }
    
  </script>
</html>
