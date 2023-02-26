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
        if (auth()->user()->can('calendar-list')) 
        {
            
        }  
        else {
          return view('pages.error-page');
       }
    }
}
