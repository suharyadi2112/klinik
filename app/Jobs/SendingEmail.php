<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ManageMail\SendEmailController; //get class dari email
use App\Helpers\Helper as HelperLog;

class SendingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailClass = new SendEmailController();
        $resultMail = $mailClass->index($this->id);//id_pendaftaran

        $Result = ['msg' => $resultMail->original['msg'], 'id' => $this->id];

        Log::info($Result);
    }
    public function tries()
    {
        return 4; // Maximum number of attempts
    }
    public function timeout()
    {
        return now()->addMinutes(10); // Timeout after 10 minutes
    }
    public function retryAfter()
    {
        return 10; // Retry after 60 seconds
    }
}
