<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop\Entity\Transaction;

class transactionController extends Controller
{
    public function transactionListPage()
    {
        $userId = session()->get('user_id');
        $rowPerPage = 10;
        $transactionPaginate = Transaction::where('user_id', $userId)
                                ->OrderBy('created_at', 'desc')
                                ->with('Merchandise')
                                ->paginate($rowPerPage);
        foreach ($transactionPaginate as $transaction) {
            if (!is_null($transaction->Merchandise->photo)) { 
                $transaction->Merchandise->photo = url($transaction->Merchandise->photo);
            }
        }
        $binding = [
            'title' => '交易紀錄',
            'transactionPaginate' => $transactionPaginate
        ];
        return view('transaction.listUserTransaction', $binding);
    }
}
