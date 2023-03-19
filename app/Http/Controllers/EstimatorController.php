<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estimator;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EstimatorController extends Controller
{
    public function index(Request $request, Estimator $estimator)
    {
        if ($request->ajax()) {

            $estimators = $estimator->getAllEstimators($request);

            $totalEstimators = Estimator::count();

            $search = $request['search']['value'];

            $setFilteredRecords = $totalEstimators;

            if(!empty($search)){
                $setFilteredRecords = $estimator->getAllEstimators($request,true);
            }

            return datatables()->of($estimators)
                ->addIndexColumn()

                ->addColumn('name', function ($estimator) {
                    return $estimator->name;
                })

                ->addColumn('created_at', function ($estimator) {
                    return $estimator->created_at;
                })

                ->addColumn('action', function ($estimator) {
                $btn = '';
                $btn .= '<a href="' . route('estimators.edit',encrypt($estimator->id)) . '" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;';
                $btn .= '<a href="javascript:void(0);" delete_form="delete_customer_form"  data-id="' .$estimator->id. '" class="delete-datatable-record text-danger delete-users-record" title="Delete"><i class="fas fa-trash"></i></a>';

                return $btn;
            })
                ->rawColumns([
                'action'
            ])->setTotalRecords($totalEstimators)->setFilteredRecords($setFilteredRecords)->skipPaging()
                ->make(true);
        }

        return view('estimator.index');
    }

    public function create()
    {
        return view('estimator.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required'             
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }  

        $estimatorArr = $request->except(['_token']);
        $model = new Estimator;
        $model = $model->fill($estimatorArr);

        if(!$model->save()){
            return redirect()->back()->with('error', 'Unable to create estimator. Please try again later.');
        }

        return redirect()->route('estimators.index')->with('success', 'Estimator created successfully.');
    }

    public function edit($id)
    {
        $estimatorObj = Estimator::find(decrypt($id));
        if(!$estimatorObj){
            return redirect()->back()->with('error', 'This estimator does not exist');
        }
        return view('estimator.edit', compact('estimatorObj'));
    }

    public function update(Request $request, $id)
    {

        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }  

        $model = Estimator::find($id);
        if(!$model){
            return redirect()->back()->with('error', 'This Estimator does not exist');
        }

        $estimatorArr = $request->except(['_method', '_token']);

        $model = $model->fill($estimatorArr);

        if($model->save()){
            return redirect()->route('estimators.index')->with('success', 'Estimator updated successfully.');
        }

        return redirect()->back()->with('error', 'Unable to update estimator. Please try again later.');
    }

    public function destroy($id)
    {
        $estimator = Estimator::find($id);
        
        if(!$estimator){
            return returnNotFoundResponse('This estimator does not exist');
        }
        
        $hasDeleted = $estimator->delete();
        if($hasDeleted){
            return returnSuccessResponse('Estimator deleted successfully');
        }
        
        return returnErrorResponse('Something went wrong. Please try again later');
    }
}
