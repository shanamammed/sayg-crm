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
                  <h4 class="page-title float-left">ADD CONTACT</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form  id="Myform" action="{{ url('admin/contacts/store') }}" method="post" enctype="multipart/form-data">
                   {!! csrf_field() !!}
                  <div id="add_data">
                     <div class="form-row">
                        <div class="col-md-6">
                          <label>Fist Name<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" name="first_name" class="form-control"  placeholder="First Name" required>
                            @error('first_name') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>Last Name</label>
                          <div class="input-group">
                            <input type="text" name="last_name" class="form-control"  placeholder="Last Name">
                            @error('last_name') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>
                      <div class="form-row">  
                        <div class="col-md-6">
                          <label>Email Address<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="email" name="email" class="form-control"  placeholder="E-mail address" required>
                            @error('email') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>Owner<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <select class="form-control" name="owner" required>
                              @foreach($owners as $owner)
                               <option value="{{ $owner->id }}" <?php if($owner->id=='1') {?> selected <?php };?>>{{ $owner->name }}</option>
                              @endforeach
                            </select>
                            @error('email') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>
                      <div class="form-row">
                       <div class="col-md-6">
                        <table id="contact-phone">
                          <thead>
                            <tr>
                              <td width="80%">Phone Number</td>
                              <td width="20%">Delete</td>
                            </tr>
                          </thead>
                          <tr>
                            <td><input type="text" class="form-control quantity" name="phones[]" id="phone"></td>
                            <td style="text-align:center;"> - </td>
                          </tr>
                        </table>
                         <div class="text-left">
                          <button type="button" class="btn btn-link" onclick="addRowSize()"> <i class="fa fa-plus" aria-hidden="true"></i></button>
                         </div>
                       </div> 
                      <!--  <div class="col-md-6">
                          <label>Source</label>
                          <div class="input-group">
                            <select class="form-control" name="source">
                              @foreach($sources as $source)
                               <option value="{{$source->id}}">{{$source->name}}</option>
                              @endforeach
                            </select>
                          </div>
                       </div>  -->
                      </div><br>
                    <!--   <div class="form-row">
                        <div class="col-md-6">
                          <label>Deals</label>
                          <div class="input-group">
                            <select class="js-example-basic-multiple" name="deals[]" multiple="multiple"> 
                              @foreach($deals as $deal)
                                <option value="{{$deal->id}}">{{$deal->name}}</option>
                                @endforeach
                            </select>
                          </div>
                          @error('deals') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                          <label>Companies</label>
                          <div class="input-group">
                            <select class="js-example-basic-multiple" name="companies[]" multiple="multiple"> 
                               @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                          </div>
                          @error('companies') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                        </div>
                      </div><br> -->   
                      <div class="form-row">
                        <div class="col-md-6">
                          <label>Company Name<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" name="company_name" class="form-control"  placeholder="Company Name" required>
                            @error('company_name') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>Company Domain</label>
                          <div class="input-group">
                            <input type="text" name="company_domain" class="form-control"  placeholder="Company Domain">
                            @error('company_domain') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>
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
  <script type="text/javascript">
        function addRowSize()
        {
         var col1 = "<tr><td><input type='text' class='form-control' name='phones[]' required></td>";
        var col2 = "<td><a class='btn btn-link' onclick='deleteRow(this);'><i style='font-size:25px; color:red;' class='fa fa-trash'></i></a></td></tr>";
        var row = col1 + col2 ;
        $('#contact-phone').append(row);
        }

        function deleteRow(row)
        {
          $(row).closest('tr').remove();
        }
    </script>
</html>
