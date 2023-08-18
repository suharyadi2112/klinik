<?php
namespace App\Http\Controllers\ManageMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\DB;
use Sentry;

class SendEmailController extends Controller
{
  public function index($id) {
      try {

          //get mail
          $resultMail = DB::table('pasien')->select('pasien.pasemail')->join('pendaftaran', 'pasien.pasid','=','pendaftaran.penpasid')->where('pendaftaran.penid', '=', $id)->first();

          Mail::to($resultMail->pasemail)->send(new NotifyMail($id));

          if (Mail::failures()) {
            return response()->json(['code' => '1', 'msg' => 'Fail'], 500);
          }else{
            return response()->json(['code' => '2', 'msg' => 'Success'], 200);
          }

      }catch (\Throwable $e) {
          Sentry::captureException($e); //set sentry queue
          return response()->json(['code' => '3', 'msg' => $e->getMessage()], 500);
      }

  }
}
