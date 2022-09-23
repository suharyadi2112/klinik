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
use Spatie\Permission\Models\Role;

use App\Helpers\Helper as HelperLog;

class ProcessTransaction extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function DelTindakanKeluar(Request $request){

        return $this->DeleteTindakanKategori($request);

    }

    public function InsertRegistration(Request $request){

        return $this->InsertRegisterParam("single", $request);

       
    }
    public function InsertRegistrationLead(Request $request){

        return $this->InsertRegisterParam("leads", $request);
       
    }

    public function InsertRegistrationAction(Request $request){

        return $this->InsertRegistrationActionParam("single", $request);
        
    }
    public function InsertRegistrationActionLeads(Request $request){

        return $this->InsertRegistrationActionParam("leads", $request);
        
    }

    public function InsertRegisActionFinish(Request $request){

        $CekDataPendaftaranLeads = DB::table('pendaftaran_leads')->where('pendaftaran_leads.penid','=',$request->id_pen)->get();
        if($CekDataPendaftaranLeads->isEmpty()){
            return response()->json(['code' => '30'], 200);
        }else{
            foreach ($CekDataPendaftaranLeads as $key => $value) {
                if ($key == 0) {
                   $res = DB::table('pendaftaran')->insertGetId([
                        'pentgl' => $value->pentgl,
                        'penpasid' => $value->penpasid,
                        'pentglrujukan' => $value->pentglrujukan,
                        'penpengid' => $value->penpengid,
                        'penpemid' => $value->penpemid,
                        'created_by' => auth()->user()->id,
                    ]);
                }
            }
            $CekDataRindakanLeads = DB::table('tindakankeluar_leads')->where('tindakankeluar_leads.tndklrpenid','=',$request->id_pen)->get();
            if($CekDataRindakanLeads->isEmpty()){
                return response()->json(['code' => '31'], 200);
            }else{
                foreach ($CekDataRindakanLeads as $keyt => $valuet) {
                    
                       $rest[] = [
                                    'tndklrtndid' => $valuet->tndklrtndid,
                                    'tndklrpenid' => $res,
                                    'tndklrharga' => $valuet->tndklrharga,
                                    // 'tndklrdiskon' => $valuet->pendaftaran_id,
                                    'tndklrdiskonprice' => $valuet->tndklrharga,
                                ];
                    
                }
                $end = DB::table('tindakankeluar')->insert($rest);
            }
            return response()->json(['code' => '2'], 200);
        }
    }

    protected function DeleteTindakanKategori($req){

        $validator = Validator::make($req->all(), [
            'id' => 'required|max:50',
            'type' => 'required|max:50',
        ]);

        if ($req->type == "ori") {
            $db = "tindakankeluar";
        }else if($req->type == "leads"){
            $db = "tindakankeluar_leads";
        }

        if ($validator->fails()) {
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{

            $deleted = DB::table($db)->where('tndklrid', '=', $req->id)->delete();
            if ($deleted) {
                return response()->json(['code' => '2'], 200);
            }else{
                return response()->json(['code' => '3'], 200);
            }

        }

    }

    protected function InsertRegistrationActionParam($type, $req){

        if ($type == "single") {
            $db = "tindakankeluar";
        }else{
            $db = "tindakankeluar_leads";
        }

        $checkExits = DB::table($db)->where([['tndklrtndid','=',$req->form_pick_action_code_id],['tndklrpenid','=',$req->pendaftaran_id]])->count();
        if ($checkExits > 0) {
           return response()->json(['code' => '1', 'fail' => 'Data already exists'], 200);
        }

        $validator = Validator::make($req->all(), [
            'pendaftaran_id' => 'required|max:50',
            'form_pick_action_code_id' => 'required|max:100',
            'price' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{
            $res = DB::table($db)->insert([
                        'tndklrtndid' => $req->form_pick_action_code_id,
                        'tndklrpenid' => $req->pendaftaran_id,
                        'tndklrharga' => $req->price,
                        // 'tndklrdiskon' => $req->pendaftaran_id,
                        'tndklrdiskonprice' => $req->price,
                    ]);

            if ($res) {
                //param pertama subject dan kedua data req
                HelperLog::addToLog('Insert action registration', json_encode($req->all()));
                return response()->json(['code' => '2']);
            }else{
                return response()->json(['code' => '3']);
            }
            
        }
    }

    protected function InsertRegisterParam($type, $req){

        if ($type == "single") {
            $db = "pendaftaran";
        }else{
            $db = "pendaftaran_leads";
        }

        $validator = Validator::make($req->all(), [
            'date_registration' => 'required|date_format:Y-m-d',
            'patient' => 'required|max:50',
            'reference_date' => 'required|date_format:Y-m-d',
            'partner' => 'required',
            'billing_of_type' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            HelperLog::addToLog('Fail VALIDATOR Insert data registration '.$db.'', json_encode($req->all())); 
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{
            $Insert =   DB::table($db)->insertGetId([
                            'pentgl' => $req->date_registration,
                            'penpasid' => $req->patient,
                            'pentglrujukan' => $req->reference_date,
                            'penpengid' => $req->partner,
                            'penpemid' => $req->billing_of_type,
                            'created_by' => auth()->user()->id,
                        ]);
            if ($Insert) {
                //param pertama subject dan kedua data req
                HelperLog::addToLog('Insert data registration '.$db.'', json_encode($req->all())); 
                return response()->json(['code' => '2', 'LastIdInsertPendaftaran' => $Insert]);
            }else{
                HelperLog::addToLog('Fail Insert data registration '.$db.'', json_encode($req->all())); 
                return response()->json(['code' => '3']);
            }   
        }

    }

}
