<!DOCTYPE html>
<html>
  <head>
    @include("admin.partials.header")
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
                  <h4 class="page-title float-left">ADD ROLE</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="card-box">
                <form  id="Myform" action="{{ url('admin/roles/store') }}" method="post" enctype="multipart/form-data">
                   {!! csrf_field() !!}
                  <div id="add_data">
                     <div class="form-row">
                        <div class="col-md-6">
                          <label>Role Name<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" name="name" class="form-control"  placeholder="Name" required>
                          </div>
                        </div>
                      </div><br>
                      <div class="form-row">
                        <div class="col-md-4">
                           <div class="form-group">
                            
                              @foreach($permissions as $permission)                           
                                  <label class="ms-checkbox-wrap ms-checkbox-primary">{{ Form::checkbox('permission[]', $permission->id, true, array('class' => 'name')) }}
                                  {{ $permission->name }}</label>
                              @endforeach
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
  
</html>
