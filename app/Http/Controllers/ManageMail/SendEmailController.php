<?php

namespace App\Http\Controllers\ManageMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\NotifyMail;


class SendEmailController extends Controller
{

    public function index() {
          Mail::to('yadisuhar05@gmail.com')->send(new NotifyMail());

          if (Mail::failures()) {
               return response()->json(['code' => 'Gagal'], 500);
          }else{
               return response()->json(['code' => 'Berhasil'], 200);
          }
     }
}
