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
                  <h4 class="page-title float-left">EDIT PRODUCT</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form  id="Myform" action="{{ url('admin/products/update/'.$product->id) }}" method="post" enctype="multipart/form-data">
                   {!! csrf_field() !!}
                  <div id="add_data">
                     <div class="form-row">
                        <div class="col-md-6">
                          <label>Product Name<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" name="name" class="form-control"  placeholder="Product Name" value="{{ $product->name }}" required>
                            @error('name') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>SKU</label>
                          <div class="input-group">
                            <input type="text" name="sku" class="form-control" value="{{ $product->sku }}" placeholder="SKU">
                            @error('sku') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>
                    
                      <div class="form-row">
                       <div class="col-md-12">
                        <table id="contact-phone">
                          <thead>
                            <tr>
                              <td width="20%">Weight (kg/lots)</td>
                              <td width="20%">Unit Price (BHD) <span style="color: red;">*</span></td>
                              <td width="20%">Direct Price (BHD)</td>
                              <td width="20%">Tax Rate (%)</td>
                              <td width="20%">Tax Label</td>
                            </tr>
                          </thead>
                          <tr>
                            <td><input type="text" class="form-control quantity" name="weight" id="weight" value="{{ $product->unit }}"></td>
                            <td><input class="form-control quantity" name="unit_price" id="unit" type="number" step="any" value="{{ $product->unit_price }}" required></td>
                            <td><input class="form-control quantity" name="direct_price" id="direct" type="number" step="any" value="{{ $product->direct_price }}"></td>
                            <td><input class="form-control quantity" name="tax_rate" id="rate" type="number" step="any" value="10" value="{{ $product->tax_rate }}"></td>
                            <td><input type="text" class="form-control quantity" name="tax_label" id="label" value="TAX" value="{{ $product->tax_label }}"></td>
                          </tr>
                        </table>
                       </div> 
                      
                      </div><br>
                      <div class="form-row">
                        <div class="col-md-12">
                          <label>Description</label>
                          <div class="input-group">
                           <textarea type="text" name="description" class="form-control">{{ $product->description }}</textarea>
                          </div>
                          @error('description') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                        </div>
                      </div><br>     
                  </div>
                  <div class="form-row">
                         <div class="col-md-6">
                           <div class="form-group">
                               <label class="ms-checkbox-wrap ms-checkbox-primary">
                                <input type="checkbox" name="active" id="cuisine" {{ $product->is_active ? 'checked' : '' }}/> <i class="ms-checkbox-check"></i>
                              </label> <span> Active </span>
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

</html>
