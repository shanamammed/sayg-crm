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
                  <h4 class="page-title float-left">EDIT DEAL</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form  id="Myform" action="{{ url('admin/deals/update/'.$deal->id) }}" method="post" enctype="multipart/form-data">
                   {!! csrf_field() !!}
                  <div id="add_data">
                     <div class="form-row">
                        <div class="col-md-6">
                          <label>Deal Name<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" name="name" class="form-control"  placeholder="Name" value="{{ $deal->name }}" required>
                            @error('name') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>Pipeline<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <select class="form-control" name="pipeline" required>
                              @foreach($pipeline as $pipe)
                               <option value="{{ $pipe->id }}" <?php if($pipe->id==$deal->pipeline_id) {?> selected <?php };?>>{{ $pipe->name }}</option>
                              @endforeach
                            </select>
                            @error('pipeline_id') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>
                      <div class="form-row">  
                        <div class="col-md-6">
                          <label>Stage<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <select class="form-control" name="stage" required>
                              @foreach($stages as $stage)
                               <option value="{{ $stage->id }}" <?php if($stage->id==$deal->stage_id) {?> selected <?php };?>>{{ $stage->name }}</option>
                              @endforeach
                            </select>
                            @error('email') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label>Amount<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="number" step="any" name="amount" id="amount" class="form-control" value="{{ $deal->amount }}" required>
                            @error('amount') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                          @if(count($deal_products) >0)
                           <div class="text-right" id="add_product" style="display:none;">
                              <button type="button" class="btn btn-link" onclick="addProduct()"> Add Product</button>
                            </div>
                            <div class="text-right" id="delete_product">
                              <button type="button" class="btn btn-link" onclick="deleteProduct()"> Don't add Product</button>                            
                            </div>
                            <input type="hidden" name="add_value" id="add_value" value="1">
                            @else
                            <div class="text-right" id="add_product" >
                              <button type="button" class="btn btn-link" onclick="addProduct()"> Add Product</button>
                            </div>
                            <div class="text-right" id="delete_product" style="display:none;">
                              <button type="button" class="btn btn-link" onclick="deleteProduct()"> Don't add Product</button>                            
                            </div>
                            <input type="hidden" name="add_value" id="add_value" value="0">
                            @endif
                        </div>
                      </div><br>
                      <div class="form-row" id="product-section">
                        
                       <div class="col-md-12">
                        <table id="contact-phone">
                          <thead>
                            <tr>
                              <td width="50%">Product Name</td>
                              <td width="20%">Unit Price (BHD)</td>
                              <td width="20%">Quantity</td>
                              <td width="20%">Total (BHD)</td>
                              <!-- <td width="10%">Delete</td> -->
                            </tr>
                          </thead>
                          @if(count($deal_products) >0)
                          @foreach($deal_products as $deal_product)
                          <tr>
                            <td><select class="form-control" name="product" id="product" onchange="GetproductByID()">
                                  <option value="">---Select product ---</option>
                                  @foreach($products as $product)
                                   <option value="{{ $product->id }}" <?php if($product->id==$deal_product->product_id) {?> selected <?php };?>> {{ $product->name }}</option>
                                  @endforeach
                                </select>
                            </td>
                            <td><input type="number" step="any" class="form-control quantity" name="price" id="price" value="{{$deal_product->unit_price}}"></td>
                            <td><input type="number" class="form-control quantity" name="quantity" id="quantity" oninput="GetTotal()" value="{{$deal_product->quantity}}"></td>
                            <td><input type="number" step="any" class="form-control quantity" name="total" id="total" value="{{$deal_product->total}}"></td>
                            <!-- <td style="text-align:center;"><td><a class='btn btn-link' onclick='deleteRow(this);'><i style='font-size:25px; color:red;' class='fa fa-trash'></i></a></td></td> -->
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td><select class="form-control" name="product" id="product" onchange="GetproductByID(this)">
                                  <option value="">---Select product ---</option>
                                  @foreach($products as $product)
                                   <option value="{{ $product->id }}" > {{ $product->name }}</option>
                                  @endforeach
                                </select>
                            </td>
                            <td><input type="number" step="any" class="form-control quantity" name="price" id="price"></td>
                            <td><input type="number" class="form-control quantity" name="quantity" id="quantity" oninput="GetTotal()"></td>
                            <td><input type="number" step="any" class="form-control quantity" name="total" id="total"></td>
                            <!-- <td style="text-align:center;"><td><a class='btn btn-link' onclick='deleteRow(this);'><i style='font-size:25px; color:red;' class='fa fa-trash'></i></a></td></td> -->
                          </tr>
                          @endif
                        </table>
                        <!--  <div class="text-left">
                          <button type="button" class="btn btn-link" onclick="addRowSize()"> <i class="fa fa-plus" aria-hidden="true"></i></button>
                         </div> -->
                       </div> 
                      
                      </div><br>

                      <div class="form-row">
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
                         <div class="col-md-6">
                          <label>Expected Close Date<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="date" name="expected_close_date" class="form-control" value="{{ date('Y-m-d') }}" required> 
                            @error('email') <span class="error" style="color:red;">{{ $message }}</span> @enderror
                          </div>
                        </div>
                      </div><br>
                       <div class="form-row">
                        <div class="col-md-6">
                          <label>Contacts</label>
                          <div class="input-group">
                            <select class="select2 form-control select2-multiple" multiple="multiple" multiple data-placeholder="" name="contacts[]">
                               @foreach($contacts as $contact)
                                 @foreach($deal_contacts as $cont)
                                    <option value="{{$contact->id}}" @if($contact->id == $cont->contact_id)selected="selected"@endif>{{$contact->first_name.' '.$contact->last_name}}</option>
                                  @endforeach
                                @endforeach
                            </select>
                          </div>
                          @error('contacts') <span class="error" style="color:red;">{{ $message }}</span> @enderror
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

  <script type="">
      function GetproductByID()
      {    
        var id = document.getElementById('product').value;
        $.ajax({
          method: "GET",
          url: "{{ url('admin/deals/get_product') }}",
          dataType : "json",
          data : { id : id },
          success : function( data )
          {

             $('#price').val(data.unit_price);
            $('#amount').val(data.unit_price);
            
          }
        });
       }

      function GetTotal()
      {
          var Price     = document.getElementById('price').value;
          var Quantity  = document.getElementById('quantity').value;
          
           var ptotal  = Price*Quantity;
           var ptotale = (ptotal).toFixed(2);
           document.getElementById('total').value = ptotale;
           document.getElementById('amount').value = ptotale;
      }

        function deleteRow(row)
        {
          $(row).closest('table').remove();
        }

        function addProduct()
        {
           $('#product-section').css('display','block');
           $("#add_product").css("display", "none");
           $("#delete_product").css("display", "block");
           document.getElementById('add_value').value = '1';
        }

        function deleteProduct()
        {
           $('#product-section').css('display','none');
           $("#add_product").css("display", "block");
           $("#delete_product").css("display", "none");
           document.getElementById('add_value').value = '0';
        }
  </script>
</html>
