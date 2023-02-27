<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\admin\Deal;
use App\Models\admin\Contact;
use App\Models\admin\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;

class CalendarController extends Controller
{
    public function index()
    {
        // if (auth()->user()->can('calendar-list')) 
        // {
            $recent_deals = DB::table('deals')
                ->select('deals.*','stages.name as stage_name')
                ->join('stages','stages.id','=','deals.stage_id')
                ->where('stages.name','!=','Won')
                ->where('stages.name','!=','Lost')
                ->orderBy('deals.id','desc')->limit(5)->get();
            $appointments = DB::table('deals')->select('deals.*','stages.name as stage_name')
                ->join('stages','stages.id','=','deals.stage_id')->get();
            foreach($appointments as $appointment)
            {
                $appointment->created_at = date('Y-m-d',strtotime($appointment->created_at));
            }
            return view('admin.calendar.view',compact('appointments','recent_deals'));
       //  }  
       //  else {
       //    return view('pages.error-page');
       // }
    }
}
