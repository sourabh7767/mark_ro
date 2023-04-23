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
use Carbon\Carbon;

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
        

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $currentMonthSale = MainForm::whereMonth('date_out', '=', $currentMonth)
                                    ->whereYear('date_out', '=', $currentYear)
                                    ->sum('sales_amount');
        
        $lastMonth = Carbon::now()->subMonth()->month;
        $currentYear = Carbon::now()->year;
        
        $lastMonthSale = MainForm::whereMonth('date_out', '=', $lastMonth)
                                    ->whereYear('date_out', '=', $currentYear)
                                    ->sum('sales_amount');

        $inProcessAmount = MainForm::whereNotNull('date_in')
                                        ->whereNull('date_out')
                                        ->sum('sales_amount');

        return view('home',compact("users","data","monthlys",'inProcessAmount','lastMonthSale','currentMonthSale'));
    }
}
