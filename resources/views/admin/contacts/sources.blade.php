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
                  <h4 class="page-title float-left">SOURCES</h4>
                   <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" onclick="add()">Add New Source</button> <br>
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
                          <th>Source</th>
                          <!-- @if (Auth::guard('admin')->user()->canany(['contact-edit', 'contact-delete'])) -->
                          <th>Action</th>
                          <!-- @endif -->
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($sources as $source)
                        <tr>
                          <td>{{ $source->name }}</td>
                        <!--   @if (Auth::guard('admin')->user()->canany(['contact-edit', 'contact-delete'])) -->
                          <td>
                            <!-- @if (Auth::guard('admin')->user()->can('contact-edit')) -->
                            <button  class="btn btn-success btn-sm btn-rounded waves-light waves-effect" onclick="edit('{{$source->id}}')"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                          <!--   @endif
                            @if (Auth::guard('admin')->user()->can('contact-delete')) -->
                             <button class="btn btn-success btn-sm btn-rounded waves-light waves-effect" onclick="del('{{$source->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
    
     <div class="modal fade" id="add-source" tabindex="-1" role="dialog" aria-labelledby="modal-5">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title has-icon text-white">ADD SOURCE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="{{ url('admin/contacts/store_source') }}" method="post" id="add-form">
                {!! csrf_field() !!}
                 <div class="form-group m-b-25">
                     <div class="col-12">
                         <label for="select">Name</label>
                         <input type="text" class="form-control" placeholder="Source Name" name="name" id="name" required>
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

  <div class="modal fade" id="edit-source" tabindex="-1" role="dialog" aria-labelledby="modal-5">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title has-icon text-white">EDIT SOURCE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="{{ url('admin/contacts/update_source') }}" method="post" id="edit-form">
                @csrf
                 <div class="form-group m-b-25">
                    <div class="form-group m-b-25">
                    <div class="col-12">
                       <label for="select">Name</label>
                       <input type="text" class="form-control" placeholder="Source Name" name="name" id="source-name" required>
                       <input type="hidden" name="source-id" id="source-id">
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

     <div class="modal fade" id="delete-source" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">DELETE SOURCE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <div class="modal-body">
                  <p>Are you sure to delete this source?</p>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                  <form class="form-horizontal" action="{{ url('admin/contacts/delete_source') }}" method="get">
                    @csrf
                      <input type="hidden" name="source_id" id="source_id">
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
        $('#add-source').modal('show');
      }

      function edit(id)
      {
        $('#source-id').val(id);
        // alert(id);
        $.ajax({
          method: "GET",
          url: "{{ url('/admin/contacts/source_details') }}",
          data : { id : id },
          dataType : "json",
          success : function(data)
          {
            // alert(data.name);
            $('#source-name').val(data.name);
            $('#edit-source').modal('show');
          }
        });
      }

      function del(id)
        {
            $('#source_id').val(id);
            $('#delete-source').modal('show');
        }
    
  </script>
</html>
