<?php

namespace App\Http\Controllers\Laboratorium;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use PDF;

use App\Helpers\Helper as HelperLog;

class ReportScreening extends Controller
{
    public function __construct()
    {
        $this->middleware(['web']);
    }

    public function UpdateScreeningSatu(Request $request, $id_regis){

        $dec_penid = Crypt::decryptString($id_regis);//decrypt id

        $validator = Validator::make($request->all(), [
            'advice' => 'required|max:500',
            'certification' => 'required|max:500',
            'conclusion_remark' => 'required|max:500',
            'recertification' => 'required|max:500',
            'remarkexam' => 'required|max:500',
        ]);

        if ($validator->fails()) {
            HelperLog::addToLog('Fail Request Data Update Reassessment Health Report', json_encode(['request data' => $request->all(), 'error message' => $validator->messages()->first() ])); 
            return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
        }else{

            if ($this->CheckExistIDRegis($dec_penid)->count() > 0) {//update jika id pendaftar exist

                $res = DB::table('screening')->where('id_pendaftaran', $dec_penid)->update([
                        'id_pendaftaran' => $dec_penid,
                        'certification' => $request->certification,
                        'remark_exam' => $request->remarkexam,
                        'place_of_exam' => $request->place_of_exam,
                        'conclusion_remark' => $request->conclusion_remark,
                        'recertification' => $request->recertification,
                        'advice' => $request->advice,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'created_by' => auth()->user()->id,
                    ]);
                if ($res) {
                    HelperLog::addToLog('Update Data Reassessment Health Report', json_encode($request->all()));
                    return response()->json(['code' => '2','id_insert' => $res], 200);
                }else{
                    HelperLog::addToLog('Fail Update Data Reassessment Health Report', json_encode($request->all())); 
                    return response()->json(['code' => '3'], 200);
                }

            }else{

                $GetIdInsert = DB::table('screening')->insert([
                        'id_pendaftaran' => $dec_penid,
                        'certification' => $request->certification,
                        'remark_exam' => $request->remarkexam,
                        'place_of_exam' => $request->place_of_exam,
                        'conclusion_remark' => $request->conclusion_remark,
                        'recertification' => $request->recertification,
                        'advice' => $request->advice,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => auth()->user()->id,
                    ]);
                if ($GetIdInsert) {//insert

                    //param pertama subject dan kedua data request
                    HelperLog::addToLog('Update (New Insert) Data Reassessment Health Report', json_encode($request->all()));
                    return response()->json(['code' => '2','id_insert' => $GetIdInsert], 200);
                }else{
                    HelperLog::addToLog('Fail Update Data Reassessment Health Report', json_encode($request->all())); 
                    return response()->json(['code' => '3'], 200);
                }   

            }

        }

    }

    protected function CheckExistIDRegis($id_regis){//cek exist data
        $res = DB::table('screening')->where('id_pendaftaran','=',$id_regis);
        return $res;
    }   




    // _________________________ ZONA PRINT_____________________________//
    public function PrintReassessmentHealth($id_regis){

        $dec_penid = Crypt::decryptString($id_regis);//decrypt id
    
        $data = [
            'id_regis' => $dec_penid,
        ];
          
        $pdf = PDF::loadView('pages/report/reassessment_health', $data);
    
        // return $pdf->download('Testing.pdf'); //ini untuk langsong download
        return $pdf->stream("Testing.pdf", array("Attachment" => false));// dipakai untuk tengok di browser

    }

}
