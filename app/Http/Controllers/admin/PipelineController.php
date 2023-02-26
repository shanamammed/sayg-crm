<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\admin\Pipeline;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;

class PipelineController extends Controller
{
    public function index()
    {
        $pipelines = Pipeline::orderBy('id','desc')->get();
        return view('admin.pipelines.view',compact('pipelines'));
    }

    public function details(Request $request)
    {  
        $id= $request->input('id');
        $data = Pipeline::find($id);
        print_r(json_encode($data));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'name' => 'required',
        ]
        );
       
        if($validator->fails())
        {
            return back()->withInput()
                        ->withErrors($validator);
        }
        else{            
            $pipeline = new Pipeline;
            $pipeline->name = $request->input('name');
            $pipeline->created_at = date('Y-m-d H:i:s');  
            $result = $pipeline->save();                    
            if($result)
            {
                return redirect()->route('pipelines')
                            ->with('success','Pipeline created successfully');
            }  
            else
            {      
                 return redirect()->route('pipelines')          
                             ->with('error','Failed to create pipeline');
            }                 
        }
    }  

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'name' => 'required'
        ]
        );
       
        if($validator->fails())
        {
            return back()->withInput()
                        ->withErrors($validator);
        }
        else{            
            $pipeline = Pipeline::find($request->input('pipeline-id'));
            $pipeline->name = $request->input('name');
            $pipeline->updated_at = date('Y-m-d H:i:s');  
            $result = $pipeline->save();                    
            if($result)
            {
                return redirect()->route('pipelines')
                            ->with('success','Pipeline updated successfully');
            }  
            else
            {      
                 return redirect()->route('pipelines')         
                             ->with('error','Failed to create source');
            }                 
        }    
    }  

    public function delete(Request $request)
    {
        $id = $request->input('pipeline_id');
        Pipeline::find($id)->delete();
        return redirect()->route('pipelines')
                        ->with('success','Pipeline deleted successfully');
    }
}
