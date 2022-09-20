<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\TypeOfBilling;
use Spatie\Permission\models\Role;

use App\Helpers\Helper as HelperLog;

class ProcessTransaction extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function InsertRegistration(Request $request){

        $validator = Validator::make($request->all(), [
            'date_registration' => 'required|date_format:Y-m-d',
            'patient' => 'required|max:50',
            'reference_date' => 'required|date_format:Y-m-d',
            'partner' => 'required',
            'billing_of_type' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            HelperLog::addToLog('Fail VALIDATOR Insert data registration', json_encode($request->all())); 
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{
            $Insert =   DB::table('pendaftaran')->insert([
                            'pentgl' => $request->date_registration,
                            'penpasid' => $request->patient,
                            'pentglrujukan' => $request->reference_date,
                            'penpengid' => $request->partner,
                            'penpemid' => $request->billing_of_type,
                        ]);
            if ($Insert) {
                //param pertama subject dan kedua data request
                HelperLog::addToLog('Insert data registration', json_encode($request->all())); 
                return response()->json(['code' => '2']);
            }else{
                HelperLog::addToLog('Fail Insert data registration', json_encode($request->all())); 
                return response()->json(['code' => '3']);
            }   
        }
    }

}
