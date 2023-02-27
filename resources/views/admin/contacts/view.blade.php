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
                  <h4 class="page-title float-left">CONTACTS</h4>
                   <ol class="breadcrumb float-right">
                    @if (Auth::guard('admin')->user()->can('contact-create'))
                    <a href="{{ url('admin/contacts/add') }}"><button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" >Add New Contact</button></a>
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
                  <table id="datatable-buttons" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th width="10%">Owner</th>
                          <th width="15%">Contact</th>
                          <th width="10%">Email</th>
                          <th width="5%">Phone</th>
                          <th width="15%">Company Name</th>
                          @if (Auth::guard('admin')->user()->canany(['contact-edit', 'contact-delete']))
                          <th width="10%">Action</th>
                          @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($contacts as $contact)
                        <tr>
                          <td>{{ $contact->owner_name }}</td>
                          <td>{{ $contact->first_name.' '.$contact->last_name }}</td>
                          <td>{{ $contact->email }}</td>
                          <td>@foreach($contact->phones as $phone)
                                 {{$phone->mobile}}<br>
                                @endforeach</td>
                          <td>                                
                            {{$contact->company_name}}
                          </td>
                          @if (Auth::guard('admin')->user()->canany(['contact-edit', 'contact-delete']))
                          <td>
                            @if (Auth::guard('admin')->user()->can('contact-edit'))
                            <a href="{{ url('admin/contacts/edit', $contact->id) }}"><button  class="btn btn-primary btn-sm btn-rounded waves-light waves-effect"><i class="fas fa-edit" aria-hidden="true"></i></button></a>
                            @endif
                            @if (Auth::guard('admin')->user()->can('contact-delete'))
                             <button class="btn btn-primary btn-sm btn-rounded waves-light waves-effect" onclick="del('{{$contact->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
    
     <div class="modal fade" id="delete-contact" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">DELETE CONTACT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <div class="modal-body">
                  <p>Are you sure to delete this contact?</p>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                  <form class="form-horizontal" action="{{ url('admin/contacts/delete') }}" method="get">
                      <input type="hidden" name="contact_id" id="contact_id">
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
      function del(contact_id)
        {
            $('#contact_id').val(contact_id);
            $('#delete-contact').modal('show');
        }
    
  </script>
</html>
