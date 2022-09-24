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

    //send request
    public function SendRequestStatus(Request $request){
        //status sementara request, requested, approve, rejected
        $user = User::with('roles')->where('id','=', auth()->user()->id)->first();//get role user
        $CekStatus = DB::table('pendaftaran')->where([['status_request','=',$request->status],['status_request','=',null]])->get();//get status sekarang

        if ($request->status == "request") {
            //check request akses
            if ($user->can('request create')) {//akses user yang bisa send request
                return $this->changeStatus($request, $request->status,"");
            }else{
                return response()->json(['code' => '1', 'fail' => 'sorry, you no have access'], 200);
            }
        }elseif($request->status == "requested"){
            if ($user->can('approved create') || $user->can('rejected create')) {//akses user yang bisa aprove and reject
                return $this->changeStatus($request, $request->status, $request->statusPilihan);
            }else{
                return response()->json(['code' => '1', 'fail' => 'sorry, you no have access'], 200);
            }
        }else{
            return response()->json(['code' => '1', 'fail' => 'sorry, we have a problem, try again later'], 200);
        }
        
    }

    //proses change status
    protected function changeStatus($req, $status, $statusPilihan){

        switch ($status) {
            case 'request':
                $var = 'requested';
                $validator = Validator::make($req->all(), [
                    'pendaftaran_id' => 'required|max:10',
                    'status' => 'required|max:20',
                ]);
            break;
            case 'requested':
                $var = $statusPilihan;
                $validator = Validator::make($req->all(), [
                    'pendaftaran_id' => 'required|max:10',
                    'status' => 'required|max:20',
                    'statusPilihan' => 'required|max:20',
                ]);
            break;
            default:
            // code...
            break;
        }

        if ($validator->fails()) {
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{
            $CekDataRindakanLeads = DB::table('tindakankeluar')->where('tindakankeluar.tndklrpenid','=',$req->pendaftaran_id)->get();
            if($CekDataRindakanLeads->isEmpty()){
                return response()->json(['code' => '1' , 'fail' => 'Action not found in this registration !', 'param' => $req->pendaftaran_id], 200);
            }else{
                // status req to requested
                $affected = DB::table('pendaftaran')->where('penid', $req->pendaftaran_id)->update(['status_request' => $var,'ket_request' => $req->keterangan]);
                if ($affected) {
                    return response()->json(['code' => '2'], 200);
                }else{
                    return response()->json(['code' => '1', 'fail' => 'fail to send request'], 200);
                }
            }
        }
    }

    public function InsertRegisActionFinish(Request $request){

        $CekDataPendaftaranLeads = DB::table('pendaftaran_leads')->where('pendaftaran_leads.penid','=',$request->id_pendftr)->get();
    
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
                        'status_request' => 'request',
                        'created_by' => auth()->user()->id,
                    ]);
                }
            }
            $CekDataRindakanLeads = DB::table('tindakankeluar_leads')->where('tindakankeluar_leads.tndklrpenid','=',$request->id_pendftr)->get();
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

            //param pertama subject dan kedua data request
            HelperLog::addToLog('Insert Registration with action finish', json_encode(["id user" => auth()->user()->id, "id pendaftar" => $res]));
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
                //param pertama subject dan kedua data request
                HelperLog::addToLog('Delete tindakan keluar', json_encode($req->all()));
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
                            'status_request' => 'request',
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
