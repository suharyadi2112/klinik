<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $idPendaftaran;
    public function __construct($idPendaftaran)
    {
        $this->id = $idPendaftaran;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $resultData = DB::table('pasien')
        ->select('pasien.*','pendaftaran.*', 'pengirim.pennama')
        ->join('pendaftaran', 'pasien.pasid','=','pendaftaran.penpasid')
        ->join('pengirim', 'pengirim.pengid','=','pendaftaran.penpengid')
        ->where('pendaftaran.penid', '=', $this->id)
        ->first();

        $subject = 'Notification for User Name: ' . $resultData->pasnama;

        return $this->subject($subject)->view('mail.setmail',['data' => $resultData]);
    }
}
