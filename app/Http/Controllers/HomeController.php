<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Estimator;
use App\Models\Vehicle;
use App\Models\Insurance;
use App\Models\AssignmentInfo;
use App\Models\MainForm;
use Validator;
use Illuminate\Support\Facades\Redirect;

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
        $users = User::where('created_by','!=', 0)->count();
        $data = User::getActiveInactiveCount();
        $monthlys = User::monthly();
        return view('home',compact("users","data","monthlys"));
    }
}
