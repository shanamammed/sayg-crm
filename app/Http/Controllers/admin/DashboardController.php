<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\admin\Deal;
use App\Models\admin\Stage;
use App\Models\admin\Contact;
use App\Models\admin\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stagges = Stage::select('id','name as stage_name')->get();
        foreach($stagges as $stage) {
            $deals = DB::table('deals')->select('id')->where('stage_id',$stage->id)->get();
            $stage->deals = $deals->count();
        }
        $stages= $stagges->pluck('stage_name','deals');
        
        $labels = $stages->values();
        $data = $stages->keys();
        // print_r($data);
        $active_deals = Deal::select('id')->where('status',1)->whereYear('created_at',date('Y'))->get()->count();
        $lost_deals = Deal::select('id')->where('status',3)->whereYear('created_at',date('Y'))->get()->count();
        $won_deals = Deal::select('id')->where('status',2)->whereYear('created_at',date('Y'))->get()->count();

        $contacts = DB::table('contacts')->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"))
                    ->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])
                    ->groupBy(DB::raw("DAYNAME(created_at)"))
                    ->pluck('count', 'day_name');
        $now = now();
        $weekStartDate = $now->copy()->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->copy()->endOfWeek()->format('Y-m-d');
        // $week = []; 
        // for ($i=0; $i <7 ; $i++) {
        //     $week[] = $weekStartDate->startOfWeek()->addDay($i)->format('Y-m-d');//push the current day and plus the mount of $i 
        // }
        $contacts = DB::table('contacts')->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"))
                    ->whereBetween('created_at', [$weekStartDate,$weekEndDate])
                    ->groupBy(DB::raw("DAYNAME(created_at)"))
                    ->pluck('count', 'day_name');

        $line_labels = $contacts->keys();
        $line_data = $contacts->values();

        $recent_deals = DB::table('deals')
                ->select('deals.*','stages.name as stage_name')
                ->join('stages','stages.id','=','deals.stage_id')
                ->where('stages.name','!=','Won')
                ->where('stages.name','!=','Lost')
                ->orderBy('deals.id','desc')->limit(3)->get();

        $expiring_deals = DB::table('deals')
                ->select('deals.*','stages.name as stage_name')
                ->join('stages','stages.id','=','deals.stage_id')
                ->where('stages.name','!=','Won')
                ->where('stages.name','!=','Lost')
                ->where('deals.expected_close_date','>=',date('Y-m-d'))
                ->orderBy('deals.expected_close_date','asc')->limit(3)->get();

        $agents =  DB::table('deals')
                ->select('deals.*','users.name as user_name')
                ->join('users','users.id','=','deals.user_id')
                ->groupBy('deals.user_id')->limit(5)->get();
        foreach($agents as $agent) {
            $deals = DB::table('deals')->select('id')->where('user_id',$agent->user_id)->count();
            $amount = DB::table('deals')->select('id')->where('user_id',$agent->user_id)->sum('amount');
            $agent->deals = $deals;
            $agent->total = $amount;
        }               

        return view('admin.dashboard.dashboard',compact('labels','data','stages','active_deals','lost_deals','won_deals','line_labels','line_data','recent_deals','expiring_deals','agents','weekStartDate','weekEndDate'));
    }

    
}
