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
                  <h4 class="page-title float-left">UPDATE STAGE</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form  id="Myform" action="{{ url('admin/stages/update/'.$stage->id) }}" method="post" enctype="multipart/form-data">
                   {!! csrf_field() !!}
                  <div id="add_data">
                     <div class="form-row">
                        <div class="col-md-6">
                          <label>Product Name<span style="color: red;">*</span></label>
                          <div class="input-group">
                           <input type="text" class="form-control" placeholder="stage Name" name="name" id="name" value="{{$stage->name}}" required>
                           @error('name') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>Pipeline</label>
                          <div class="input-group">
                            <select class="form-control" name="pipeline_id" required>
                            @foreach($pipelines as $pipeline)
                            <option value="{{ $pipeline->id }}" <?php if($pipeline->id==$stage->pipeline_id) {?> selected <?php };?>>{{ $pipeline->name }}</option>
                            @endforeach
                           </select>
                            @error('pipeline') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>   
                  </div>
                
                <div class="form-row">
                  <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary waves-light waves-effect w-md pull-right" id="submit-button" style="display:block;">Update</button>
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
  
</html>
