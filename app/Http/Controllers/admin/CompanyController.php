<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\admin\Company;
use App\Models\admin\Contact;
use App\Models\admin\Deal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $companies = Company::select('companies.id','companies.name','domain','companies.email','users.name as owner_name','companies.created_at')
            ->join('users','users.id','=','companies.user_id')
            ->orderBy('companies.id','desc')
            ->get();
           return view('admin.companies.view',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user    = auth::guard('admin')->user()->id;
        $owners  = User::select('id','name')->where('active','1')
                       ->orderBy('name','asc')->get();
        $contacts = Contact::select('id','first_name','last_name')
                      ->orderBy('first_name','asc')->get();
        $deals = Deal::select('id','name')->orderBy('name','asc')->get();
        return view('admin.companies.add',compact('owners','contacts','deals','user')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'name' => 'required',
            'domain' => 'required|unique:companies,domain',
            'owner' => 'required'
        ],
        [ 
            'domain.domain' => 'Please enter a valid domain',
            'owner.required' => 'Please select the owner'
         ]
        );
       
        if($validator->fails())
        {
            return back()->withInput()
                        ->withErrors($validator);
        }
        else{            
            $company = new Company;
            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->domain = $request->input('domain');
            $company->user_id = $request->input('owner');
            $company->owner_assigned_date = date('Y-m-d H:i:s');
            $company->created_by = auth::guard('admin')->user()->id;
            $company->is_active = '1';
            $company->created_at = date('Y-m-d H:i:s');  
            $company->save();                  
            if($company)
            {
                if($request->deals)
                {
                    foreach($request->deals as $deal) {
                        DB::table('deal_companies')->insert(
                            array('company_id' => $company->id,
                                      'deal_id' => $deal
                                     )); 
                    }
                }

                if($request->contacts)
                {
                    foreach($request->contacts as $contact) {
                        DB::table('company_contacts')->insert(
                            array('company_id' => $company->id,
                                      'contact_id' => $contact
                                 ));
                    }
                }
            }        
            return redirect()->route('companies')
                            ->with('success','Company created successfully');
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
        $company = Company::find($id);
        $user    = auth::guard('admin')->user()->id;
        $owners  = User::select('id','name')->where('active','1')
                       ->orderBy('name','asc')->get();
        $contacts = Contact::select('id','first_name','last_name')
                      ->orderBy('first_name','asc')->get();
        $company_contacts = DB::table('company_contacts')->select('contact_id')->where('company_id',$id)->get();
        $deals = Deal::select('id','name')->orderBy('name','asc')->get();
        $company_deals = DB::table('deal_companies')->select('deal_id')->where('company_id',$id)->get();
        return view('admin.companies.edit',compact('company','user','owners','contacts','deals','company_deals','company_contacts'));
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
        $validator = Validator::make($request->all(),  [
            'name' => 'required',
            'domain' => 'required|unique:companies,domain,'.$id,
            'owner' => 'required',
        ],
        [ 
            'domain.domain' => 'Please enter a valid domain',
            'owner.required' => 'Please select the owner'
         ]
        );
       
        if($validator->fails())
        {
            return back()->withInput()
                        ->withErrors($validator);
        }
        else{     
            $company = Company::find($id);       
            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->domain = $request->input('domain');
            $company->user_id = $request->input('owner');
            $company->created_by = auth::guard('admin')->user()->id;
            $company->is_active   = isset($request->active) ? "1" : "0";
            $company->updated_at= date('Y-m-d H:i:s');
            $result = $company->save();
            if($result)
            {
                DB::table('deal_companies')->where('company_id',$id)->delete();
                if($request->deals)
                {   
                    foreach($request->deals as $deal) {
                        DB::table('deal_companies')->insert(
                            array('company_id' => $id,
                                      'deal_id' => $deal
                                 ));
                    }
                }
                
                DB::table('company_contacts')->where('company_id',$id)->delete(); 
                if($request->contacts)
                {
                    foreach($request->contacts as $contact) {
                        DB::table('company_contacts')
                            ->insert(array('company_id' => $id,
                                      'contact_id' => $contact
                                     ));
                    }
                }
            }        
            return redirect()->route('companies')
                            ->with('success','Company updated successfully');
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
        $id = $request->input('company_id');
        Role::find($id)->delete();
        return redirect()->route('roles')
                        ->with('success','Role deleted successfully');
    }
}
