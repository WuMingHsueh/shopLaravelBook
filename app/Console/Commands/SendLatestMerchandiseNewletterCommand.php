<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendMerchandiseNewsletterJob;
use App\Shop\Entity\Merchandise;
use App\Shop\Entity\User;

class SendLatestMerchandiseNewletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:sendLatesMerchandiseNewsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[郵件] 寄送最近商品電子報';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('寄送最新商品電子報(Start) ');
        $this->info('撈取最新商品');
        $totalRow = 10;
        $merchandiseCollection = Merchandise::OrderBy('created_at', 'desc')
                                 ->where('status', 'S')
                                 ->take($totalRow)
                                 ->get();
        $rowPerPage = 100;
        $page = 1;
        while (true) {
            $skip = ($page - 1) * $rowPerPage;
            $this->comment('取得使用者資料，第 ' . $page . ' 頁，每頁 ' . $rowPerPage . ' 筆');
            $userCollection = User::OrderBy('id', 'asc')
                              ->skip($skip)
                              ->take($rowPerPage)
                              ->get();
            if (!$userCollection) {
                break;
            }
            $this->comment('派送會員電子信 (Start) ');
            foreach ($userCollection as $user) {
                // 派送會員信
                SendMerchandiseNewsletterJob::dispatch($user, $merchandiseCollection)->onQueue('low');
            }
            $this->comment('派送會員電子信 (End) ');
            $page++;
        }
        // do {
        //     $skip = ($page - 1) * $rowPerPage;
        //     $this->comment('取得使用者資料，第 ' . $page . ' 頁，每頁 ' . $rowPerPage . ' 筆');
        //     $userCollection = User::OrderBy('id', 'asc')
        //                       ->skip($skip)
        //                       ->take($rowPerPage)
        //                       ->get();
        //     $this->comment('派送會員電子信 (Start) ');
        //     foreach ($userCollection as $user) {
        //         // 派送會員信
        //         SendMerchandiseNewsletterJob::dispatch($user, $merchandiseCollection)->onQueue('low');
        //     }
        //     $this->comment('派送會員電子信 (End) ');
        //     $page++;
        // } while ($userCollection);
        $this->question('沒有使用者資料了，停止派送電子報');
        $this->info('寄送醉金商品電子報 (end)');
    }
}
