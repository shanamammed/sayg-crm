<!DOCTYPE html>
<html>
  <head>
    @include("admin.partials.header")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
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
                  <h4 class="page-title float-left">EDIT USER</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form  id="Myform" action="{{ url('admin/users/update/'.$user->id) }}" method="post" enctype="multipart/form-data">
                   {!! csrf_field() !!}
                  <div id="add_data">
                     <div class="form-row">
                        <div class="col-md-6">
                          <label>User Name<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" name="name" class="form-control"  placeholder="Name" value="{{$user->name}}" required>
                            @error('name') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>User Email Address<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="email" name="email" class="form-control"  placeholder="E-mail address" value="{{$user->email}}" required>
                            @error('email') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>
                       <div class="form-row">
                        <div class="col-md-6">
                          <label>User Roles<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <select class="js-example-basic-multiple" name="roles[]" multiple="multiple" required> 
                              @foreach($roles as $role)
                                <option value="{{ $role->id }}"  @if(in_array($role->id, $userRole)) selected @endif>{{ $role->name }}</option>
                               @endforeach
                            </select>
                          </div>
                          @error('roles') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                        </div>                   
                      </div><br>  
                      <div class="form-row">
                         <div class="col-md-6">
                           <div class="form-group">
                               <label class="ms-checkbox-wrap ms-checkbox-primary">
                                <input type="checkbox" name="active" id="cuisine" {{ $user->active ? 'checked' : '' }}/> <i class="ms-checkbox-check"></i>
                              </label> <span> Active </span>
                           </div>
                        </div>
                      </div>   
                  </div>
                
                <div class="form-row">
                  <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-success waves-light waves-effect w-md pull-right" id="submit-button" style="display:block;">Add</button>
                  </div>
                </div> 
           
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
      @include("admin.partials.footer")
  </div>
  </body>
  @include("admin.partials.scripts")
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="">
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
     });
  </script>
</html>
