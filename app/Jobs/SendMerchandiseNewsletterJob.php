<?php

namespace App\Jobs;

use App\Shop\Entity\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMerchandiseNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user ;
    protected $merchandiseCollection;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Collection $merchandiseCollection)
    {
        $this->user = $user;
        $this->merchandiseCollection = $merchandiseCollection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailBinding = [
            'User'                  => $this->User,
            'MerchandiseCollection' => $this->merchandiseCollection
        ];

        Mail::send(
            'email.merchandiseNewsletter',
            $mailBinding,
            function ($mail) use ($mailBinding) {
                $mail->to($mailBinding['User']->email);
                $mail->from('rick1870@ares.com.tw');
                $mail->subject('shop Laravel 最新商品電子報');
            }
        );
    }
}
