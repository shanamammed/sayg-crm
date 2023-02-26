<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\admin\Pipeline;
use App\Models\admin\Stage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::select('stages.id','stages.name','pipelines.name as pipeline')
          ->join('pipelines','pipelines.id','=','stages.pipeline_id')
          ->orderBy('id','desc')->get();
        $pipelines = Pipeline::orderBy('id','desc')->get();  
        return view('admin.stages.view',compact('stages','pipelines'));
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
            $stage = new Stage;
            $stage->name = $request->input('name');
            $stage->pipeline_id = $request->input('pipeline_id');
            $stage->created_at = date('Y-m-d H:i:s');  
            $result = $stage->save();                    
            if($result)
            {
                return redirect()->route('stages')
                            ->with('success','Stage created successfully');
            }  
            else
            {      
                 return redirect()->route('stages')          
                             ->with('error','Failed to create stage');
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
            $stage = Stage::find($request->input('stage-id'));
            $stage->name = $request->input('name');
            $stage->pipeline_id = $request->input('pipeline_id');
            $stage->updated_at = date('Y-m-d H:i:s');  
            $result = $stage->save();                    
            if($result)
            {
                return redirect()->route('stages')
                            ->with('success','Stage updated successfully');
            }  
            else
            {      
                return redirect()->route('stages')         
                             ->with('error','Failed to create source');
            }                 
        }    
    }  

    public function delete(Request $request)
    {
        $id = $request->input('stage_id');
        Stage::find($id)->delete();
        return redirect()->route('stages')
                        ->with('success','Stage deleted successfully');
    }
}
