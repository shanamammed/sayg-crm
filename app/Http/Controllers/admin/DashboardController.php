<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stagges = DB::table('stages')->select('id','name as stage_name')            
             ->get();
        foreach($stagges as $stage) {
            $deals = DB::table('deals')->select('id')->where('stage_id',$stage->id)->count();
            $stage->deals = $deals;
        }
        $stages= $stagges->pluck('stage_name','deals');
       
        $labels = $stages->values();
        $data = $stages->keys();

        $total_deals = DB::table('deals')->select('id')->whereYear('created_at',date('Y'))->get()->count();
        $lost_deals = DB::table('deals')->select('id')->where('stage_id',4)->whereYear('created_at',date('Y'))->get()->count();
        $won_deals = DB::table('deals')->select('id')->where('stage_id',3)->whereYear('created_at',date('Y'))->get()->count();

        $contacts = DB::table('contacts')->select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"))
                    ->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])
                    ->groupBy(DB::raw("DAYNAME(created_at)"))
                    ->pluck('count', 'day_name');
 
        $line_labels = $contacts->keys();
        $line_data = $contacts->values();

        $recent_deals = DB::table('deals')
                ->select('deals.*','stages.name as stage_name')
                ->join('stages','stages.id','=','deals.stage_id')
                ->where('stages.name','!=','Won')
                ->where('stages.name','!=','Lost')
                ->orderBy('deals.id','desc')->limit(5)->get();
        $appointments = DB::table('deals')->select('*')->get();
        foreach($appointments as $appointment)
        {
            $appointment->created_at = date('Y-m-d',strtotime($appointment->created_at));
        }
        // return view('admin.dashboard.dashboard',compact('appointments','recent_deals'));

        // print_r($data);
        return view('admin.dashboard.dashboard',compact('labels','data','stages','total_deals','lost_deals','won_deals','line_labels','line_data'));
    }

    
}
