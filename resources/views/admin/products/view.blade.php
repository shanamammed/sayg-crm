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
                  <h4 class="page-title float-left">PRODUCTS</h4>
                   <ol class="breadcrumb float-right">
                    @if (Auth::guard('admin')->user()->can('product-create'))
                    <a href="{{ url('admin/products/add') }}"><button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" >Add New Product</button></a>
                    @endif
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
                          <th width="20%">Product Name</th>
                          <th width="10%">SKU</th>
                          <th width="10%">Unit Price</th>
                          <th width="10%">Tax Rate</th>
                          <th width="10%">Status</th>
                          @if (Auth::guard('admin')->user()->canany(['product-edit', 'product-delete']))
                          <th width="10%">Action</th>
                          @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($products as $product)
                        <tr>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->sku }}</td>
                          <td>{{ $product->unit_price }} BHD</td>
                          <td>{{ $product->tax_rate }} %</td>
                          <td>                                
                            <div class="flex items-center justify-center {{ $product->is_active ? 'text-success' : 'text-danger' }}">
                                <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $product->is_active  ? 'Active' : 'Inactive' }}
                            </div>
                          </td>
                          @if (Auth::guard('admin')->user()->canany(['product-edit', 'product-delete']))
                          <td>
                            @if (Auth::guard('admin')->user()->can('product-edit'))
                            <a href="{{ url('admin/products/edit', $product->id) }}"><button  class="btn btn-success btn-sm btn-rounded waves-light waves-effect"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                            @endif
                            @if (Auth::guard('admin')->user()->can('product-delete'))
                             <button class="btn btn-success btn-sm btn-rounded waves-light waves-effect" onclick="del('{{$product->id}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
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
    
     <div class="modal fade" id="delete-product" tabindex="-1" role="dialog" aria-labelledby="modal-5">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title has-icon text-white">DELETE PRODUCT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
               <div class="modal-body">
                  <p>Are you sure to delete this product?</p>
               </div>
               <div class="modal-footer">
                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                  <form class="form-horizontal" action="{{ url('admin/products/delete') }}" method="get">
                      <input type="hidden" name="product_id" id="product_id">
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
      function del(product_id)
        {
            $('#product_id').val(product_id);
            $('#delete-product').modal('show');
        }
    
  </script>
</html>
