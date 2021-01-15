<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use Http;
use App\Models\User;
use Auth;
use Session;
use DB;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function login(Request $request)
    {
      
        if (Auth::attempt($request->only('email','password'))) {
                return redirect()->route('home')->with('welcome',''); 
        }
        return redirect()->back()->with('error','');
    
    }

    public function home(Request $request)
    {
        $data['title'] = 'Dashboard';
         return view('backend.index', compact('data'));
    }
}

