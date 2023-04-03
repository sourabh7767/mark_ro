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
use Validator, Auth;
use Illuminate\Support\Facades\Redirect;
use Excel;
use App\Exports\MainFormExport;

class MainFormController extends Controller
{
    public function index(Request $request, Customer $customer)
    {
        if ($request->ajax()) {

            $customers = $customer->getAllCustomers($request);

            $totalCustomers = Customer::count();

            $search = @$request['search'];

            $setFilteredRecords = $totalCustomers;

            if(!empty($search)){

                $setFilteredRecords = $customer->getAllCustomers($request,true);

            }

            return datatables()->of($customers)
                ->addIndexColumn()

                ->addColumn('full_name', function ($customer) {
                    return $customer->full_name.' '.$customer->last_name;
                })

                ->addColumn('year', function ($customer) {
                    return $customer->year;
                })

                ->addColumn('make', function ($customer) {
                    return $customer->make;
                })

                ->addColumn('model', function ($customer) {
                    return $customer->model;
                })

                ->addColumn('estimator_name', function ($customer) {
                    return $customer->estimator_name;
                })

                ->addColumn('insurance_company', function ($customer) {
                    return $customer->insurance_company;
                })

                ->addColumn('status', function ($customer) {
                    return ucfirst($customer->status);
                })

                ->addColumn('action', function ($customer) {
                $btn = '<a href="'.route("form.view", $customer->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="'.route("form.edit", $customer->id).'"><i class="fa fa-edit" aria-hidden="true"></i></a>';

                return $btn;
            })
                ->rawColumns([
                'action',
                'status'
            ])->setTotalRecords($totalCustomers)->setFilteredRecords($setFilteredRecords)->skipPaging()
                ->make(true);
        }

        return view('main-form.index');
    }

    public function createForm(Request $request){

        $estimators = Estimator::all();

        if($request->isMethod('post')){
            $data = $request->except("_token");
            // echo "<pre>"; print_r($data); die;

            $rules = array(
                'full_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email',
                'phone_code' => 'required',
                'iso_code' => 'required',
                'phone_number' => 'required|digits_between:7,12',
                'estimator_name' => 'required|numeric',
                // 'priority' => 'required',
                'year' => 'required|numeric|min:1900|max:'.date("Y"),
                'make' => 'required',
                'model' => 'required',
                'ro' => 'required',
                // 'exterior_color' => 'required',
                // 'body_style' => 'required',
                // 'interior_color' => 'required',
                // 'engine' => 'required',
                // 'paint_code' => 'required',
                // 'mileage_in' => 'required',
                // 'mileage_out' => 'required',
                // 'trim_code' => 'required',
                //'production_date' => 'required',
                // 'license_plate' => 'required',
                'insurance_company' => 'required',
                // 'claim_office' => 'required',
                // 'adjuster' => 'required',
                // 'policy_number' => 'required',
                // 'insurance_agent' => 'required',
                // 'deductible' => 'required',
                // 'claim_number' => 'required',
                // 'claim_type' => 'required',
                // 'loss_type' => 'required',
                // 'loss_time' => 'required',
                // 'payer' => 'required',
                // 'insurance_prepaid_amount' =>'required|numeric',
                //'insurance_phone_number' => 'digits_between:7,12'
            );

            $messages = array('full_name.required' => "The first name field is required.");

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator->errors());
            }

            $customer = new Customer;
            $customer->user_id = Auth::user()->id;
            $customer->full_name = $data['full_name'];
            $customer->last_name = $data['last_name'];
            $customer->email = $data['email'];
            $customer->phone_code = $data['phone_code'];
            $customer->iso_code = $data['iso_code'];
            $customer->phone_number = $data['phone_number'];

            if($customer->save()){
                $customer_id =  $customer->id;

                $vehicle = new Vehicle;
                $vehicle->make = $data['make'];
                $vehicle->year = $data['year'];
                $vehicle->model = $data['model'];
                $vehicle->exterior_color = $data['exterior_color'];
                $vehicle->body_style = @$data['body_style'];
                $vehicle->interior_color = @$data['interior_color'];
                $vehicle->engine = @$data['engine'];
                $vehicle->paint_code = @$data['paint_code'];
                $vehicle->mileage_in = @$data['mileage_in'];
                $vehicle->mileage_out = @$data['mileage_out'];
                $vehicle->trim_code = @$data['trim_code'];
                $vehicle->production_date = @$data['production_date'];
                $vehicle->license_plate = @$data['license_plate'];
                $vehicle->licence_state = @$data['licence_state'];
                $vehicle->customer_id = $customer_id;

                if($vehicle->save()){
                    $insurance = new Insurance;

                    $insurance->insurance_company = @$data['insurance_company'];
                    $insurance->claim_office = @$data['claim_office'];
                    $insurance->adjuster = @$data['adjuster'];
                    $insurance->policy_number = @$data['policy_number'];
                    $insurance->insurance_agent = @$data['insurance_agent'];
                    $insurance->deductible = @$data['deductible'];
                    $insurance->phone_number = @$data['insurance_phone_number'];
                    $insurance->customer_id = $customer_id;

                    if($insurance->save()){
                        $assignmentInfo = new AssignmentInfo;

                        $assignmentInfo->claim_number = @$data['claim_number'];
                        $assignmentInfo->claim_type = @$data['claim_type'];
                        $assignmentInfo->loss_type = @$data['loss_type'];
                        $assignmentInfo->loss_time = @$data['loss_time'];
                        $assignmentInfo->payer = @$data['payer'];
                        $assignmentInfo->insurance_prepaid_amount = @$data['insurance_prepaid_amount'];
                        $assignmentInfo->customer_id = $customer_id;

                        if($assignmentInfo->save()){
                            $mainForm = new MainForm;
                            $mainForm->customer_id = $customer_id;
                            $mainForm->priority = @$data['priority'];
                            $mainForm->estimator_id = @$data['estimator_name'];
                            $mainForm->ro = @$data['ro'];
                            $mainForm->user_id = Auth::user()->id;
                            $mainForm->status = 'open';
                            
                            if($mainForm->save()){
                                return redirect()->route('forms.index')->with('success', 'Form saved successfully');
                            }else{
                                return redirect()->route('forms.index')->with('error', 'Form saved successfully');
                            }
                        }
                    }
                }
            }
        }

        return view('main-form.create', compact('estimators'));
    }

    public function view($customer_id){

        $customer = Customer::select("customers.*","vehicles.*", "estimators.name as estimator_name", "insurances.*", "insurances.phone_number as insurance_phone_number", "main_forms.*", "assignment_infos.*")
        ->leftJoin('vehicles', 'customers.id', '=', 'vehicles.customer_id')
        ->leftJoin('main_forms', 'customers.id', '=', 'main_forms.customer_id')
        ->leftJoin('estimators', 'estimators.id', '=', 'main_forms.estimator_id')
        ->leftJoin('insurances', 'insurances.customer_id', '=', 'customers.id')
        ->leftJoin('assignment_infos', 'assignment_infos.customer_id', '=', 'customers.id')
        ->where("customers.id", $customer_id)
        ->first();
        // echo "<pre>"; print_r($customer->toArray()); die;

        return view('main-form.view', compact('customer'));
    }

    public function edit(Request $request, $customer_id){

        $estimators = Estimator::all();
        $customer = Customer::select("customers.*", "customers.phone_number as customer_phone_number","vehicles.*", "estimators.name as estimator_name", "estimators.id as estimator_id", "insurances.*", "insurances.phone_number as insurance_phone_number", "main_forms.*", "assignment_infos.*")
        ->leftJoin('vehicles', 'customers.id', '=', 'vehicles.customer_id')
        ->leftJoin('main_forms', 'customers.id', '=', 'main_forms.customer_id')
        ->leftJoin('estimators', 'estimators.id', '=', 'main_forms.estimator_id')
        ->leftJoin('insurances', 'insurances.customer_id', '=', 'customers.id')
        ->leftJoin('assignment_infos', 'assignment_infos.customer_id', '=', 'customers.id')
        ->where("customers.id", $customer_id)
        ->first();

        if($request->isMethod('post')){
            $data = $request->except("_token");
            // echo "<pre>"; print_r($data); die;

            $rules = array(
                'full_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email',
                'phone_code' => 'required',
                'iso_code' => 'required',
                'phone_number' => 'required|digits_between:7,12',
                'estimator_name' => 'required|numeric',
                // 'priority' => 'required',
                'year' => 'required|numeric|min:1900|max:'.date("Y"),
                'make' => 'required',
                'model' => 'required',
                'ro' => 'required',
                'status' => 'required',
                // 'exterior_color' => 'required',
                // 'body_style' => 'required',
                // 'interior_color' => 'required',
                // 'engine' => 'required',
                // 'paint_code' => 'required',
                // 'mileage_in' => 'required',
                // 'mileage_out' => 'required',
                // 'trim_code' => 'required',
                //'production_date' => 'required',
                // 'license_plate' => 'required',
                'insurance_company' => 'required',
                // 'claim_office' => 'required',
                // 'adjuster' => 'required',
                // 'policy_number' => 'required',
                // 'insurance_agent' => 'required',
                // 'deductible' => 'required',
                // 'claim_number' => 'required',
                // 'claim_type' => 'required',
                // 'loss_type' => 'required',
                // 'loss_time' => 'required',
                // 'payer' => 'required',
                // 'insurance_prepaid_amount' =>'required|numeric',
                //'insurance_phone_number' => 'digits_between:7,12'
            );

            $messages = array('full_name.required' => "The first name field is required.");

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator->errors());
            }

            $customer = Customer::where("id", $customer_id)->first();
            $customer->user_id = Auth::user()->id;
            $customer->full_name = $data['full_name'];
            $customer->last_name = $data['last_name'];
            $customer->email = $data['email'];
            $customer->phone_code = $data['phone_code'];
            $customer->iso_code = $data['iso_code'];
            $customer->phone_number = $data['phone_number'];

            if($customer->save()){
                $vehicle = Vehicle::where("customer_id", $customer_id)->first();
                $vehicle->make = $data['make'];
                $vehicle->year = $data['year'];
                $vehicle->model = $data['model'];
                $vehicle->exterior_color = $data['exterior_color'];
                $vehicle->body_style = @$data['body_style'];
                $vehicle->interior_color = @$data['interior_color'];
                $vehicle->engine = @$data['engine'];
                $vehicle->paint_code = @$data['paint_code'];
                $vehicle->mileage_in = @$data['mileage_in'];
                $vehicle->mileage_out = @$data['mileage_out'];
                $vehicle->trim_code = @$data['trim_code'];
                $vehicle->production_date = @$data['production_date'];
                $vehicle->license_plate = @$data['license_plate'];
                $vehicle->licence_state = @$data['licence_state'];

                if($vehicle->save()){
                    $insurance = Insurance::where("customer_id", $customer_id)->first();

                    $insurance->insurance_company = @$data['insurance_company'];
                    $insurance->claim_office = @$data['claim_office'];
                    $insurance->adjuster = @$data['adjuster'];
                    $insurance->policy_number = @$data['policy_number'];
                    $insurance->insurance_agent = @$data['insurance_agent'];
                    $insurance->deductible = @$data['deductible'];
                    $insurance->phone_number = @$data['insurance_phone_number'];

                    if($insurance->save()){
                        $assignmentInfo = AssignmentInfo::where("customer_id", $customer_id)->first();

                        $assignmentInfo->claim_number = @$data['claim_number'];
                        $assignmentInfo->claim_type = @$data['claim_type'];
                        $assignmentInfo->loss_type = @$data['loss_type'];
                        $assignmentInfo->loss_time = @$data['loss_time'];
                        $assignmentInfo->payer = @$data['payer'];
                        $assignmentInfo->insurance_prepaid_amount = @$data['insurance_prepaid_amount'];

                        if($assignmentInfo->save()){
                            $mainForm = MainForm::where("customer_id", $customer_id)->first();
                            $mainForm->priority = @$data['priority'];
                            $mainForm->estimator_id = @$data['estimator_name'];
                            $mainForm->ro = @$data['ro'];
                            $mainForm->status = @$data['status'];
                            $mainForm->user_id = Auth::user()->id;
                            
                            if($mainForm->save()){
                                return redirect()->route('forms.index')->with('success', 'Form updated successfully');
                            }else{
                                return redirect()->route('forms.index')->with('error', 'Form updated successfully');
                            }
                        }
                    }
                }
            }
        }

        return view('main-form.edit', compact('estimators','customer'));
    }
    
    public function exportExcel(){
        $file_name = 'employees_'.date('Y_m_d_H_i_s').'.xlsx';
       return Excel::download(new MainFormExport, $file_name);
    }
}
