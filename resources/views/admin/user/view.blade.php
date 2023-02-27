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
                  <h4 class="page-title float-left">USERS</h4>
                   <ol class="breadcrumb float-right">
                    @if (Auth::guard('admin')->user()->can('user-create'))
                    <a href="{{ url('admin/users/add') }}"><button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" >Add New User</button></a>
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
                            <a href="{{ url('admin/users/edit', $user->id) }}"><button  class="btn btn-primary btn-sm btn-rounded waves-light waves-effect"><i class="fas fa-edit" aria-hidden="true"></i></button></a>
                            @endif
                            @if (Auth::guard('admin')->user()->can('user-delete'))
                             <button class="btn btn-primary btn-sm btn-rounded waves-light waves-effect" onclick="del('{{$user->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                            @endif 
                            <button class="btn btn-primary btn-sm btn-rounded waves-light waves-effect" onclick="change('{{$user->id}}')">Password</button></a>
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
      
       <div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="modal-5">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title has-icon text-white">CHANGE PASSWORD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="{{ url('admin/users/change_password') }}" method="post" id="change-form">
                @csrf
                 <div class="form-group m-b-25">
                    <div class="form-group m-b-25">
                      <div class="col-12">
                       <label for="select">New Password</label>
                       <input type="text" class="form-control" id="pass-1" required>
                       <input type="hidden" name="u_id" id="u_id">
                    </div>
                    </div>
                    <div class="form-group m-b-25">
                      <div class="col-12">
                       <label for="select">Confirm Password</label>
                        <input type="text" name="password" class="form-control" id="pass-2" required>
                       <input type="hidden" name="pipeline-id" id="pipeline-id">
                    </div>
                    </div>
                 </div>
               </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                    <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit" id="submit-button">Update</button>
                  </div>
              </form>
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
      function del(user_id)
        {
            $('#user_id').val(user_id);
            $('#delete-user').modal('show');
        }
    
  </script>
  <script>
      function change(user_id)
        {
            $('#u_id').val(user_id);
            $('#change-password').modal('show');
        }
    $('#change-form').on('submit', function(e){
      e.preventDefault();
      $('#submit-button').attr('disabled',true);
      var pass1 = $('#pass-1').val();
      var pass2 = $('#pass-2').val();
      if (pass1 == pass2) {
        document.getElementById("change-form").submit();
      }
      else {
        // toastr.error('The New password and Confirmation password does not match..!');
        alert('The New password and Confirmation password does not match..!');
        $('#submit-button').attr('disabled',false);
      }
      });
  </script>
</html>
