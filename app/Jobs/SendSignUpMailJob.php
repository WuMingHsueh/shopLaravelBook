<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendSignUpMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mailBinding;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mailBinding)
    {
        $this->mailBinding = $mailBinding;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailBinding = $this->mailBinding ;
        Mail::send('email.signUpEmailNotification', $mailBinding, function ($mail) use ( $mailBinding ) {
            $mail->to($mailBinding['email']);
            $mail->from('rick1870@ares.com.tw');
            $mail->subject('恭喜註冊 shop Laravel 成功');
        });
    }
}
