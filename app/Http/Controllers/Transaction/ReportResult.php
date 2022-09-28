<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Storage;
use PDF;

use App\Helpers\Helper as HelperTglIndo;

use Carbon\Carbon;

class ReportResult extends Controller
{
    public function __construct(){
        $this->middleware(['web']);
    }

    public function ReportPDFResult($id_registration){
        $dec_penid = Crypt::decryptString($id_registration);//decrypt id

        $resbasic = $this->GetInfoRegistration($dec_penid);//basic data
        $age = Carbon::parse($resbasic->pastgllahir)->age;//to age
        
        $data = [
            'id_registration' => $dec_penid,
            'data_basic' => $resbasic,
            'age' => $age,
            'jeniskelamin' => $this->artijk($resbasic->pasjk),
            'tanggalrujukindo' => HelperTglIndo::tanggal_indo($resbasic->pentglrujukan),
        ];
          
        $pdf = PDF::loadView('pages/report/result_report', $data);
    
        // return $pdf->download('Testing.pdf'); //ini untuk langsong download
        return $pdf->stream("Testing.pdf", array("Attachment" => false));// dipakai untuk tengok di browser
    }

    //arti jenis kelamin
    protected function artijk($jk){
        if ($jk == "Man" || $jk == "man") {
            return "Laki-laki";
        }else if($jk == "Women" || $jk == "women"){
            return "Perempuan";
        }else{
            return "Lainnya";
        }
    }

    //cek akses
    protected function CheckAcc(){
        $userAcc = User::with('roles')->where('id','=', auth()->user()->id)->first();//get role user
        return $userAcc;
    }

    protected function GetInfoRegistration($id_pen){
        $data = DB::table('pendaftaran')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->orderBy('penid', 'desc')
            ->where('pendaftaran.penid','=',$id_pen)
            ->first();
        return $data;
    }

    protected function GetInfoLaboratorium($id_pen){
        $data = DB::table('pendaftaran')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->join('tindakankeluar','tindakankeluar.tndklrpenid','=','pendaftaran.penid')
            ->join('tindakan','tindakan.tndid','=','tindakankeluar.tndklrtndid')
            ->join('kategoritindakan','kategoritindakan.kattndid','=','tindakan.tndkattndid')
            ->join('katlab', 'katlab.katlabtndid','=','tindakankeluar.tndklrtndid')
            ->orderBy('penid', 'desc')
            ->where('pendaftaran.penid','=',$id_pen)
            ->get();
        return $data;
    }

}
