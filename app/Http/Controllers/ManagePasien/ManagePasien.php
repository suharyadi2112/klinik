<?php

namespace App\Http\Controllers\ManagePasien;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper as HelperLog;

class ManagePasien extends Controller
{
    public function __construct(){
        $this->middleware(['web']);
    }

    public function ShowPatient(Request $request){

        if ($request->ajax()) {
           $data = DB::table('pasien')
                   ->orderBy('pasid', 'desc')
                   ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn =
                                '
                                <a href="/patient/update/'.$row->pasid.'">
                                <button type="button" class="btn btn-sm round btn-info">edit</button>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger round delPatient" data-id="'.$row->pasid .'">del</button>
                                '
                                ;
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $breadcrumbs = [
          ['link' => "/patient", 'name' => "Patient"], ['link' => "/patient", 'name' => "List Patient"], ['name' => "Dashboard Patient"],
        ];
        
        
        return view("/patient/patient");
    }

    public function AddPatient(){

        HelperLog::addToLog('Show form add patient', json_encode(auth()->user()->id));
        $breadcrumbs = [
          ['link' => "/patient", 'name' => "Dashboard Patient"], ['link' => "/patient/registration", 'name' => "Form Patient"], ['name' => "Form Partner"],
        ];
        
        $identity = DB::table('f_identitas')->get(); 
        $gender   = DB::table('f_gender')->get(); 
        $blood    = DB::table('f_goldar')->get(); 
        $religion = DB::table('f_agama')->get(); 
        $status   = DB::table('f_statuskawin')->get(); 
        $job      = DB::table('f_pekerjaan')->get(); 
        $kwn      = DB::table('f_kwn')->get(); 

        return view("/patient/registration",['breadcrumbs' => $breadcrumbs, 'identity' => $identity, 'gender' => $gender, 'blood' => $blood, 'religion' => $religion, 'status' => $status, 'job' => $job, 'kwn' => $kwn]);

    }

    public function InsertPatient(Request $request){

        $validator = Validator::make($request->all(), [
            'identitas' => 'required',
            'identitas_id' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date_format:Y-m-d',
            'umur' => 'required',
            'gender' => 'required',
            'gol_dar' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kel' => 'required',
            'kec' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required',
            'kwn' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            HelperLog::addToLog('Fail VALIDATOR Insert data patient', json_encode($request->all())); 
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{
            $Insert =   DB::table('pasien')->insert([
                            'pasnama' => $request->nama,
                            'pasalamat' => $request->alamat,
                            'pasumur' => $request->umur,
                            'pastlp' => $request->no_hp,
                            'pasemail' => $request->email,
                            'pastgllahir' => $request->tgl_lahir,
                            'pasjk' => $request->gender,
                            'pasnik' => $request->identitas_id,
                            'paskec' => $request->kec,
                            'pastempatlahir' => $request->tempat_lahir,
                            'pasgol' => $request->gol_dar,
                            'pasrt' => $request->rt,
                            'pasrw' => $request->rw,
                            'paskel' => $request->kel,
                            'pasagama' => $request->agama,
                            'passtatus' => $request->status,
                            'paspekerjaan' => $request->pekerjaan,
                            'pasnegara' => $request->kwn,
                            'pasidentitas' => $request->identitas,
                            
                        ]);
            if ($Insert) {
                //param pertama subject dan kedua data request
                HelperLog::addToLog('Insert data patient', json_encode($request->all())); 
                return response()->json(['code' => '2']);
            }else{
                HelperLog::addToLog('Fail Insert data patient', json_encode($request->all())); 
                return response()->json(['code' => '3']);
            }   
        }

    }

    public function PatientEdit($id){

        $ct     = DB::table('pasien')
                ->where('pasid', '=', $id)
                ->first();

        $identity = DB::table('f_identitas')->get(); 
        $gender   = DB::table('f_gender')->get(); 
        $blood    = DB::table('f_goldar')->get(); 
        $religion = DB::table('f_agama')->get(); 
        $status   = DB::table('f_statuskawin')->get(); 
        $job      = DB::table('f_pekerjaan')->get(); 
        $kwn      = DB::table('f_kwn')->get(); 

        return view("/patient/update",['identity' => $identity, 'gender' => $gender, 'blood' => $blood, 'religion' => $religion, 'status' => $status, 'job' => $job, 'kwn' => $kwn, 'ct' => $ct]);

    }


    public function UpdatePatient(Request $request){

        $validator = Validator::make($request->all(), [
            'identitas' => 'required',
            'identitas_id' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date_format:Y-m-d',
            'umur' => 'required',
            'gender' => 'required',
            'gol_dar' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kel' => 'required',
            'kec' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required',
            'kwn' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            HelperLog::addToLog('Fail VALIDATOR Update data Patient', json_encode($request->all())); 
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{
            $update     = DB::table('pasien')
                          ->where('pasid', $request->id)
                          ->update([
                                    'pasnama' => $request->nama,
                                    'pasalamat' => $request->alamat,
                                    'pasumur' => $request->umur,
                                    'pastlp' => $request->no_hp,
                                    'pasemail' => $request->email,
                                    'pastgllahir' => $request->tgl_lahir,
                                    'pasjk' => $request->gender,
                                    'pasnik' => $request->identitas_id,
                                    'paskec' => $request->kec,
                                    'pastempatlahir' => $request->tempat_lahir,
                                    'pasgol' => $request->gol_dar,
                                    'pasrt' => $request->rt,
                                    'pasrw' => $request->rw,
                                    'paskel' => $request->kel,
                                    'pasagama' => $request->agama,
                                    'passtatus' => $request->status,
                                    'paspekerjaan' => $request->pekerjaan,
                                    'pasnegara' => $request->kwn,
                                    'pasidentitas' => $request->identitas,
                                   ]
                                   );
            if ($update) {
                //param pertama subject dan kedua data request
                HelperLog::addToLog('Update data patient', json_encode($request->all())); 
                return response()->json(['code' => '2']);
            }else{
                HelperLog::addToLog('Fail Update data patient', json_encode($request->all())); 
                return response()->json(['code' => '3']);
            }   
        }

    }

    public function delPatient($id){

        $res = HelperLog::addToLog('Delete data patient', json_encode($id));
        DB::table('pasien')->where('pasid', '=', $id)->delete();
        return response()->json(['code' =>  '1', 'res' => $res]);

    }
}
