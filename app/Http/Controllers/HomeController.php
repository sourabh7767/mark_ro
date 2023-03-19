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
    
    public function createForm(Request $request){

        $estimators = Estimator::all();

        if($request->isMethod('post')){
            $data = $request->except("_token");
            // echo "<pre>"; print_r($data); die;

            $rules = array(
                'full_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone_code' => 'required',
                'iso_code' => 'required',
                'phone_number' => 'required|numeric',
                'estimator_name' => 'required|numeric',
                'priority' => 'required',
                'make_year' => 'required|digits:4',
                'exterior_color' => 'required',
                'body_style' => 'required',
                'interior_color' => 'required',
                'engine' => 'required',
                'paint_code' => 'required',
                'mileage_in' => 'required',
                'mileage_out' => 'required',
                'trim_code' => 'required',
                'production_date' => 'required|date',
                'license_plate' => 'required',
                'insurance_company' => 'required',
                'claim_office' => 'required',
                'adjuster' => 'required',
                'policy_number' => 'required',
                'insurance_agent' => 'required',
                'deductible' => 'required',
                'claim_number' => 'required',
                'claim_type' => 'required',
                'loss_type' => 'required',
                'loss_time' => 'required',
                'payer' => 'required',
                'insurance_prepaid_amount' =>'required|numeric',
                'insurance_phone_number' => 'required|numeric'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $customer = new Customer;
            $customer->full_name = $data['full_name'];
            $customer->last_name = $data['last_name'];
            $customer->email = $data['email'];
            $customer->phone_code = $data['phone_code'];
            $customer->iso_code = $data['iso_code'];
            $customer->phone_number_1 = $data['phone_number'];

            if($customer->save()){
                $customer_id =  $customer->id;

                $vehicle = new Vehicle;
                $vehicle->make_year = $data['make_year'];
                $vehicle->exterior_color = $data['exterior_color'];
                $vehicle->body_style = $data['body_style'];
                $vehicle->interior_color = $data['interior_color'];
                $vehicle->engine = $data['engine'];
                $vehicle->paint_code = $data['paint_code'];
                $vehicle->mileage_in = $data['mileage_in'];
                $vehicle->mileage_out = $data['mileage_out'];
                $vehicle->trim_code = $data['trim_code'];
                $vehicle->production_date = $data['production_date'];
                $vehicle->license_plate = $data['license_plate'];
                $vehicle->customer_id = $customer_id;

                if($vehicle->save()){
                    $insurance = new Insurance;

                    $insurance->insurance_company = $data['insurance_company'];
                    $insurance->claim_office = $data['claim_office'];
                    $insurance->adjuster = $data['adjuster'];
                    $insurance->policy_number = $data['policy_number'];
                    $insurance->insurance_agent = $data['insurance_agent'];
                    $insurance->deductible = $data['deductible'];
                    $insurance->phone_number = $data['insurance_phone_number'];
                    $insurance->customer_id = $customer_id;

                    if($insurance->save()){
                        $assignmentInfo = new AssignmentInfo;

                        $assignmentInfo->claim_number = $data['claim_number'];
                        $assignmentInfo->claim_type = $data['claim_type'];
                        $assignmentInfo->loss_type = $data['loss_type'];
                        $assignmentInfo->loss_time = $data['loss_time'];
                        $assignmentInfo->payer = $data['payer'];
                        $assignmentInfo->insurance_prepaid_amount = $data['insurance_prepaid_amount'];
                        $assignmentInfo->customer_id = $customer_id;

                        if($assignmentInfo->save()){
                            $mainForm = new MainForm;
                            $mainForm->customer_id = $customer_id;
                            $mainForm->priority = $data['priority'];
                            $mainForm->estimator_id = $data['estimator_name'];
                            
                            if($mainForm->save()){
                                return redirect()->back()->with('success', 'Form saved successfully');
                            }else{
                                return redirect()->back()->with('error', 'Form saved successfully');
                            }
                        }
                    }
                }
            }
        }

        return view('create-form', compact('estimators'));
    }
}
