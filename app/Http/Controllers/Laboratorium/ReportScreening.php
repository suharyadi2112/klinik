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

    public function UpdateScreening(Request $request, $id_regis, $type){//REASSESSMENT HEALTH

        $dec_penid = Crypt::decryptString($id_regis);//decrypt id

        if ($type == 'screening_satu') {
        
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
                            'status_page_one' => 1,
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
                        return response()->json(['code' => '2','type' => $type], 200);
                    }else{
                        HelperLog::addToLog('Fail Update Data Reassessment Health Report', json_encode($request->all())); 
                        return response()->json(['code' => '3'], 200);
                    }

                }else{

                    $GetIdInsert = DB::table('screening')->insert([
                            'id_pendaftaran' => $dec_penid,
                            'status_page_one' => 1,
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
                        return response()->json(['code' => '2','type' => $type], 200);
                    }else{
                        HelperLog::addToLog('Fail Update Data Reassessment Health Report', json_encode($request->all())); 
                        return response()->json(['code' => '3'], 200);
                    }   

                }

            }

        }else if($type == 'screening_dua'){//page 2 health screening report

            $arr_tojson = json_encode($request->all());// request all to json

            if ($this->CheckExistIDRegis($dec_penid)->count() > 0) {//update jika id pendaftar exist
                $Resss = DB::table('screening')->where('id_pendaftaran', $dec_penid)->update(["health_screening_report_one" => $arr_tojson,'updated_at' => date('Y-m-d H:i:s'), 'status_page_two' => 1,]);

                if ($Resss) {
                    HelperLog::addToLog('Update Data Health Screening Report Page 2', json_encode($request->all()));
                    return response()->json(['code' => '2','type' => $type], 200);
                }else{
                    HelperLog::addToLog('Fail Update Health Screening Report Page 2', json_encode($request->all())); 
                    return response()->json(['code' => '3'], 200);
                }
            }else{
                $Ress = DB::table('screening')->insert([
                            'id_pendaftaran' => $dec_penid,
                            'status_page_two' => 1,
                            'health_screening_report_one' => $arr_tojson,
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => auth()->user()->id,
                        ]);
                if ($Ress) {
                    //param pertama subject dan kedua data request
                    HelperLog::addToLog('Update (New Insert) Health Screening Report Page 2', json_encode($request->all()));
                    return response()->json(['code' => '2','type' => $type], 200);
                }else{
                    HelperLog::addToLog('Fail Update Data Health Screening Report Page 2', json_encode($request->all())); 
                    return response()->json(['code' => '3'], 200);
                }
            }

        }else if($type == 'screening_tiga'){
                
            $arr_tojson = json_encode($request->all());

            if ($this->CheckExistIDRegis($dec_penid)->count() > 0) {
                $Resss = DB::table('screening')->where('id_pendaftaran', $dec_penid)->update(["health_screening_report_two" => $arr_tojson,'updated_at' => date('Y-m-d H:i:s'), 'status_page_three' => 1,]);
                if ($Resss) {
                    HelperLog::addToLog('Update Data Health Screening Report Page 3', json_encode($request->all()));
                    return response()->json(['code' => '2','type' => $type], 200);
                }else{
                    HelperLog::addToLog('Fail Update Health Screening Report Page 3', json_encode($request->all())); 
                    return response()->json(['code' => '3'], 200);
                }
            }else{
                 $Ress = DB::table('screening')->insert([
                            'id_pendaftaran' => $dec_penid,
                            'status_page_three' => 1,
                            'health_screening_report_two' => $arr_tojson,
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => auth()->user()->id,
                        ]);
                if ($Ress) {
                    //param pertama subject dan kedua data request
                    HelperLog::addToLog('Update (New Insert) Health Screening Report Page 3', json_encode($request->all()));
                    return response()->json(['code' => '2','type' => $type], 200);
                }else{
                    HelperLog::addToLog('Fail Update Data Health Screening Report Page 3', json_encode($request->all())); 
                    return response()->json(['code' => '3'], 200);
                }
            }

        }else{
            return response()->json(['code' => '3', 'not in condition'], 200);
        }

    }

    // _________________________ ZONA PRINT_____________________________//
    public function PrintReassessmentHealth($id_regis, $type){

        $dec_penid = Crypt::decryptString($id_regis);//decrypt id
        $resdata = $this->GetInfoRegistration($dec_penid);

        if ($type == 'screening_satu') {
         
            if ($this->CheckExistIDRegis($dec_penid)->count() > 0 && $resdata->status_page_one == 1) {//check data screening jika tidak ada
                $data = [
                    'id_regis' => $dec_penid,
                    'data' => $resdata,
                    'jk' => $this->artijk($resdata->pasjk),
                    'tgl_ttd' => HelperLog::tanggal_indo(date('Y-m-d'))
                ];
                  
                $pdf = PDF::loadView('pages/report/reassessment_health', $data);
                $pdf->set_paper("A4", "portrait");
                //log
                HelperLog::addToLog('Print Reassessment Health', json_encode($data)); 
                // return $pdf->download('Testing.pdf'); //ini untuk langsong download
                return $pdf->stream("Testing.pdf", array("Attachment" => false));// dipakai untuk tengok di browser
            }else{
                return redirect()->route('ReportScreening',['id_regis' => $id_regis])->with('error', 'Data Screening Not Found, Update Screening First !');
            }

        }elseif ($type == 'screening_dua') {
            
            if ($this->CheckExistIDRegis($dec_penid)->count() > 0 && $resdata->status_page_two == 1) {//check data screening jika tidak ada

                $ResJpageTwo = json_decode($resdata->health_screening_report_one, true);//decode json data
                dd($ResJpageTwo);

            }else{
                return redirect()->route('ReportScreening',['id_regis' => $id_regis])->with('error', 'Data Screening Not Found, Update Screening First !');
            }
        
        }elseif($type == 'screening_tiga'){

            if ($this->CheckExistIDRegis($dec_penid)->count() > 0 && $resdata->status_page_three == 1) {//check data screening jika tidak ada

                $ResPhysical = DB::select("select
                            a.id_print_screening,
                            b.id_physical,
                            b.name_physical 
                            from screening a
                            inner join physical_examination b ON JSON_CONTAINS( a.health_screening_report_two, 
                            CAST( CONCAT('\"',b.id_physical,'\"') AS JSON), '$.physical_examination') where a.id_pendaftaran = ?", [$dec_penid]);

                dd($ResPhysical);

                $ResJpageThree = json_decode($resdata->health_screening_report_two, true);//decode json data
                $data = [
                    'id_regis' => $dec_penid,
                    'data' => $resdata,
                    'json_data' => $ResJpageThree,
                    'jk' => $this->artijk($resdata->pasjk),
                    'tgl_ttd' => HelperLog::tanggal_indo(date('Y-m-d'))
                ];

                $pdf = PDF::loadView('pages/report/health_screening_report_tiga', $data);
                $pdf->set_paper("A4", "portrait");
                //log
                HelperLog::addToLog('Print Health Screening Report Page 3', json_encode($data)); 
                // return $pdf->download('Testing.pdf'); //ini untuk langsong download
                return $pdf->stream("Testing.pdf", array("Attachment" => false));// dipakai untuk tengok di browser

            }else{
                return redirect()->route('ReportScreening',['id_regis' => $id_regis])->with('error', 'Data Screening Not Found, Update Screening First !');
            }

        }else{
            return redirect()->route('ReportScreening',['id_regis' => $id_regis])->with('error', 'Internal Server Error !');
        }



    }

    protected function GetInfoRegistration($id_pen){
        $data = DB::table('pendaftaran')
            ->select('pendaftaran.*','pasien.*','pengirim.*','jenispembayaran.*','screening.*','users.name')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->join('screening','screening.id_pendaftaran','=','pendaftaran.penid')
            ->join('users','users.id','=','pendaftaran.created_by')
            ->orderBy('penid', 'desc')
            ->where('pendaftaran.penid','=',$id_pen)
            ->first();
        return $data;
    }

    protected function CheckExistIDRegis($id_regis){//cek exist data
        $res = DB::table('screening')->where('id_pendaftaran','=',$id_regis);
        return $res;
    }   
    //arti jenis kelamin
    protected function artijk($jk){
        if ($jk) {
            if ($jk == "Man" || $jk == "man") {
                return "Laki-laki";
            }else if($jk == "Women" || $jk == "women"){
                return "Perempuan";
            }else{
                return "Lainnya";
            }
        }else{
            return "-";
        }
    }

}



// $arr_tojson = json_encode($request->all());
//       //check array deskripsi ada isi atau tidak
//       $arrdesabnor = array_filter($request->describe_abnormalities, function($a) {return trim($a) !== "";});

//       if(!empty($request->physical_examination)){

//           if ($arrdesabnor) {//cek deskripsi jika diisi, tapi physical tidak dicentang
//               for ($i=0; $i < count($request->physical_examination); $i++) { 
//                   if (!in_array($request->physical_examination[$i], array_keys($arrdesabnor))) {
//                       return response()->json(['code' => '1', 'fail' => 'Physical Examination, No/Normal - Yes/Abnormal Required !'], 200);
//                   }
//               }

//               $validator = Validator::make($request->all(), [
//                   'physical_examination' => 'required|max:11',
//               ],['physical_examination.required' => 'Physical Examination, No/Normal - Yes/Abnormal Required !']);

//               $ResValid = $validator->fails();
//           }else{
//               $ResValid = false;
//           }

//           return response()->json(['code' => '1', 'fail' => count($request->physical_examination)], 200);
//       }else{
//           return response()->json(['code' => '1', 'fail' => "nil"], 200);
//       }

//       if ($ResValid) {
//           HelperLog::addToLog('Fail Request Data Update Health Screening Report Page 3', json_encode(['request data' => $request->all(), 'error message' => $validator->messages()->first() ])); 
//           return response()->json(['code' => '1', 'fail' => $validator->messages()->first()], 200);
//       }
