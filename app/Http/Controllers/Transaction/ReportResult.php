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

class ReportResult extends Controller
{
    public function __construct(){
        $this->middleware(['web']);
    }

    public function ReportPDFResult($id_registration){
        $dec_penid = Crypt::decryptString($id_registration);//decrypt id
        $data = [
            'title' => 'Tes untuk configurasi dompdf',
            'date' => date('m/d/Y'),
            'id_registration' => $dec_penid
        ];
          
        $pdf = PDF::loadView('pages/report/result_report', $data);
    
        // return $pdf->download('Testing.pdf'); //ini untuk langsong download
        return $pdf->stream("Testing.pdf", array("Attachment" => false));// dipakai untuk tengok di browser
    }
}
