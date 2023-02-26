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
                  <h4 class="page-title float-left">EDIT COMPANY</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form  id="Myform" action="{{ url('admin/companies/update/'.$company->id) }}" method="post" enctype="multipart/form-data">
                   {!! csrf_field() !!}
                  <div id="add_data">
                     <div class="form-row">
                        <div class="col-md-6">
                          <label>Company Name<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" name="name" class="form-control"  placeholder="Name" value="{{$company->name}}" required>
                            @error('name') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>Company Domain<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" name="domain" class="form-control"  placeholder="Company Domain" value="{{$company->domain}}" required>
                            @error('domain') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>
                      <div class="form-row">  
                        <div class="col-md-6">
                          <label>Email Address<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="email" name="email" class="form-control"  placeholder="E-mail address" value="{{$company->email}}" required>
                            @error('email') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>Owner<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <select class="form-control" name="owner" required>
                              @foreach($owners as $owner)
                               <option value="{{ $owner->id }}" <?php if($owner->id==$company->user_id) {?> selected <?php };?>>{{ $owner->name }}</option>
                              @endforeach
                            </select>
                            @error('email') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>
                       <div class="form-row">
                        <div class="col-md-6">
                          <label>Deals</label>
                          <div class="input-group">
                            <select class="js-example-basic-multiple" name="deals[]" multiple="multiple"> 
                             @foreach($deals as $deal)
                              @foreach($company_deals as $comp_deal)
                                  <option value="{{$deal->id}}" @if($deal->id == $comp_deal->deal_id)selected="selected"@endif>{{$deal->name}}</option>
                                 @endforeach 
                              @endforeach
                            </select>
                          </div>
                          @error('deals') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                          <label>Contacts</label>
                          <div class="input-group">
                            <select class="js-example-basic-multiple" name="contacts[]" multiple="multiple"> 
                               @foreach($contacts as $contact)
                                 @foreach($company_contacts as $cont)
                                    <option value="{{$contact->id}}" @if($contact->id == $cont->contact_id)selected="selected"@endif>{{$contact->first_name.' '.$contact->last_name}}</option>
                                @endforeach
                                @endforeach
                            </select>
                          </div>
                          @error('contacts') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                        </div>
                      </div><br> 
                      <div class="form-row">
                         <div class="col-md-6">
                           <div class="form-group">
                               <label class="ms-checkbox-wrap ms-checkbox-primary">
                                <input type="checkbox" name="active" id="cuisine" {{ $company->is_active ? 'checked' : '' }}/> <i class="ms-checkbox-check"></i>
                              </label> <span> Active </span>
                           </div>
                        </div>
                      </div>     
                  </div>
                
                <div class="form-row">
                  <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-success waves-light waves-effect w-md pull-right" id="submit-button" style="display:block;">Update</button>
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
