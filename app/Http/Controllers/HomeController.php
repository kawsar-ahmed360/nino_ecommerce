<?php

namespace App\Http\Controllers;

use App\Models\Admin\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['info'] = User::where('id',Auth::user()->id)->first();
        $data['logo'] = Setting::where('id','1')->first();
        return view('UserDashboard.main',$data);
    }
}
