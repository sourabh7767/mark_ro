<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // public function addresses(){
    //     return $this->hasOne(UserAddress::class);
    // }

    public static function getColumnForSorting($value){

        $list = [
            0=>'id',
            1=>'full_name',
            2=>'email',
            4=>'created_at'
        ];

        return isset($list[$value])?$list[$value]:"";
    }

    public function getAllCustomers($request = null,$flag = false)
    {
        $columnNumber = $request['order'][0]['column'];
        $order = $request['order'][0]['dir'];

        $column = self::getColumnForSorting($columnNumber);

        if($columnNumber == 0){
            $order = "desc";
        }

        if(empty($column)){
            $column = 'id';
        }
        
        $query = self::select("customers.*","vehicles.year", "vehicles.make","vehicles.model", "estimators.name as estimator_name", "insurances.insurance_company", "main_forms.status")
        ->leftJoin('vehicles', 'customers.id', '=', 'vehicles.customer_id')
        ->leftJoin('main_forms', 'customers.id', '=', 'main_forms.customer_id')
        ->leftJoin('estimators', 'estimators.id', '=', 'main_forms.estimator_id')
        ->leftJoin('insurances', 'insurances.customer_id', '=', 'customers.id')
        ->orderBy($column, $order);

        if(!empty($request)){

             //echo "<pre>"; print_r($request["search"]); die;
            $search = @$request['search'];
            $status = @$request['status'];

            if(!empty($search)){
                $query->where(function ($query) use($request,$search){
                    $query->orWhere( 'full_name', 'LIKE', '%'. $search .'%')
                        ->orWhere( 'last_name', 'LIKE', '%'. $search .'%');
                        // ->orWhere('customers.created_at', 'LIKE', '%' . $search . '%')
                        // ->orWhere('estimators.name', 'LIKE', '%' . $search . '%')
                        // ->orWhere('insurance_company', 'LIKE', '%' . $search . '%')
                        // ->orWhere('year', 'LIKE', '%' . $search . '%')
                        // ->orWhere('make', 'LIKE', '%' . $search . '%');
                });

                if($status == 'open' || $status == 'closed'){
                    $query->where('main_forms.status', '=', $status);
                }

                if($flag)
                    return $query->count();
            }

            if($status == 'open' || $status == 'closed'){
                $query->where('main_forms.status', '=', $status);

                if($flag)
                    return $query->count();
            }

            $start =  $request['start'];
            $length = $request['length'];
            $query->offset($start)->limit($length);
        }

        $query = $query->get();
        return $query;
    }
}
