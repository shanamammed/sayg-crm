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
                  <h4 class="page-title float-left">PIPELINES</h4>
                   <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" onclick="add()">Add New Pipeline</button> <br>
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
                          <th>Pipeline</th>
                          <!-- @if (Auth::guard('admin')->user()->canany(['contact-edit', 'contact-delete'])) -->
                          <th>Action</th>
                          <!-- @endif -->
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pipelines as $pipeline)
                        <tr>
                          <td>{{ $pipeline->name }}</td>
                        <!--   @if (Auth::guard('admin')->user()->canany(['contact-edit', 'contact-delete'])) -->
                          <td>
                            <!-- @if (Auth::guard('admin')->user()->can('contact-edit')) -->
                            <button  class="btn btn-success btn-sm btn-rounded waves-light waves-effect" onclick="edit('{{$pipeline->id}}')"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <!--   @endif
                            @if (Auth::guard('admin')->user()->can('contact-delete')) -->
                             <button class="btn btn-success btn-sm btn-rounded waves-light waves-effect" onclick="del('{{$pipeline->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                            <!-- @endif  -->
                          </td>
                          <!-- @endif -->
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
    
     <div class="modal fade" id="add-pipeline" tabindex="-1" role="dialog" aria-labelledby="modal-5">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title has-icon text-white">ADD PIPELINE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="{{ url('admin/pipelines/store') }}" method="post" id="add-form">
                {!! csrf_field() !!}
                 <div class="form-group m-b-25">
                     <div class="col-12">
                         <label for="select">Name</label>
                         <input type="text" class="form-control" placeholder="pipeline Name" name="name" id="name" required>
                     </div>
                 </div>
               </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                    <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit" id="submit-button">Add</button>
                  </div>
              </form>
          </div>
        </div>
      </div>

  <div class="modal fade" id="edit-pipeline" tabindex="-1" role="dialog" aria-labelledby="modal-5">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title has-icon text-white">EDIT PIPELINE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="{{ url('admin/pipelines/update') }}" method="post" id="edit-form">
                @csrf
                 <div class="form-group m-b-25">
                    <div class="form-group m-b-25">
                    <div class="col-12">
                       <label for="select">Name</label>
                       <input type="text" class="form-control" placeholder="pipeline Name" name="name" id="pipeline-name" required>
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

     <div class="modal fade" id="delete-pipeline" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">DELETE PIPELINE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <div class="modal-body">
                  <p>Are you sure to delete this pipeline?</p>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                  <form class="form-horizontal" action="{{ url('admin/pipelines/delete') }}" method="get">
                    @csrf
                      <input type="hidden" name="pipeline_id" id="pipeline_id">
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
      function add()
      {
        $('#add-pipeline').modal('show');
      }

      function edit(id)
      {
        $('#pipeline-id').val(id);
        // alert(id);
        $.ajax({
          method: "GET",
          url: "{{ url('/admin/pipelines/details') }}",
          data : { id : id },
          dataType : "json",
          success : function(data)
          {
            // alert(data.name);
            $('#pipeline-name').val(data.name);
            $('#edit-pipeline').modal('show');
          }
        });
      }

      function del(id)
        {
            $('#pipeline_id').val(id);
            $('#delete-pipeline').modal('show');
        }
    
  </script>
</html>
