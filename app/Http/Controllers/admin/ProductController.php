<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\admin\Product;
use DB;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('id','DESC')->get();
        return view('admin.products.view',compact('products'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validator = Validator::make($request->all(),  [
            'name' => 'required',
            'unit_price' => 'required|numeric',
            'direct_price' => 'nullable|numeric',
        ]);
        if($validator->fails())
        {
            return back()->withInput()
                        ->withErrors($validator);
        }
        else{
            $product = new Product;
            $product->name = $request->name;
            $product->sku  = $request->sku;
            $product->unit_price  = $request->unit_price;
            $product->direct_cost = $request->direct_price;
            $product->unit        = $request->weight;
            $product->tax_rate    = $request->tax_rate;
            $product->tax_label   = $request->tax_label; 
            $product->created_by  = $user->id;           
            $product->is_active   = "1";
            $result = $product->save();
        
            return redirect()->route('products')
                            ->with('success','Product created successfully');
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $validator = Validator::make($request->all(),  [
            'name' => 'required',
            'unit_price' => 'required|numeric',
            'direct_price' => 'nullable|numeric',
        ]);
        if($validator->fails())
        {
            return back()->withInput()
                        ->withErrors($validator);
        }
        else{
            $product = Product::find($id);
            $product->name = $request->name;
            $product->sku  = $request->sku;
            $product->unit_price  = $request->unit_price;
            $product->direct_cost = $request->direct_price;
            $product->unit        = $request->weight;
            $product->tax_rate    = $request->tax_rate;
            $product->tax_label   = $request->tax_label;            
            $product->is_active   = isset($request->active) ? "1" : "0";
            $result = $product->save();
        
            return redirect()->route('products')
                            ->with('success','Product updated successfully');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('product_id');
        Product::find($id)->delete();
        return redirect()->route('products')
                        ->with('success','Product deleted successfully');
    }
}
