<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop\Entity\Merchandise;
use App\Shop\Entity\Transaction;
use App\Shop\Entity\User;
use Validator;
use Image;
use DB;
class MerchandiseController extends Controller
{
    public function merchandiseListPage()
    {
        $rowPerPage = 10; // 每頁的資料量
        //撈取商品分頁資料
        $merchandisePaginate = Merchandise::OrderBy('updated_at', 'desc')
                                ->where('status', 'S') //可販售
                                ->paginate($rowPerPage);
        
        foreach ($merchandisePaginate as $merchandise) {
            if (!is_null($merchandise->photo)) {
                $merchandise->photo = url($merchandise->photo);
            }
        }

        $binding = [
            'title' => '商品列表',
            'MerchandisePaginate' => $merchandisePaginate
        ];
        return view('merchandise.listMerchandise', $binding);
    }

    public function merchandiseItemPage($merchandise_id) 
    {
        $merchandise = Merchandise::findOrFail($merchandise_id);
        if (!is_null($merchandise->photo)) {
            $merchandise->photo = url($merchandise->photo);
        }
        $binding = [
            'title' => '商品頁',
            'merchandise' => $merchandise
        ];
        return view('merchandise.showMerchandise', $binding);
    }

    public function merchandiseCreateProcess()
    {
        $merchandise_data = [
            'status'                  => 'C',
            'name'                    => '',
            'name_en'                 => '',
            'introduction'            => '',
            'introduction_en'         => '',
            'photo'                   => null,
            'price'                   => 0,
            'remain_count'            => 0
        ];
        $merchandise = Merchandise::create($merchandise_data);
        return redirect('/merchandise/'. $merchandise->id . '/edit');
    }

    public function merchandiseItemEditPage($merchandise_id)
    {
        $merchandise = Merchandise::findOrFail($merchandise_id);
        if (!is_null($merchandise->photo)) {
            $merchandise->photo = url($merchandise->photo);
        }

        $binding = [
            'title' => '編輯商品',
            'Merchandise' => $merchandise
        ];
        return view('merchandise.editMerchandise', $binding);
    }

    public function merchandiseItemUpdateProcess($merchandise_id)
    {
        $Merchandise = Merchandise::findOrFail($merchandise_id);
        $input = request()->all();

        $rules = [
            'status' => [
                'required',
                'in:C,S'
            ],
            'name' => [
                'required',
                'max:80'
            ],
            'name_en' => [
                'required',
                'max:80'
            ],
            'introduction' => [
                'required',
                'max:2000'
            ],
            'introduction_en' => [
                'required',
                'max:2000'
            ],
            'photo' => [
                'file',
                'image',
                'max: 10240' // 10 MB
            ],
            'price' => [
                'required',
                'integer',
                'min:0'
            ],
            'remain_count' => [
                'required',
                'integer',
                'min:0'
            ]
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect('/merchandise/'. $Merchandise->id . '/edit')->withErrors($validator)->withInput();
        }

        if (isset($input['photo'])) {
            $photo = $input['photo'];
            $fileExtension = $photo->getClientOriginalExtension(); //檔案附檔名
            $fileName = uniqid() . '.' . $fileExtension; // 隨機檔名
            $fileRelativePath = 'images/merchandise/'. $fileName; // 檔案相對目錄
            $filePath = public_path($fileRelativePath); // 檔案存放目錄於 對外公開
            $image = Image::make($photo)->fit(450, 300)->save($filePath);
            $input['photo'] = $fileRelativePath;
        }
        $Merchandise->update($input);

        return redirect('/merchandise/' . $Merchandise->id . '/edit');
    }

    public function merchandiseManageListPage()
    {
        $rowPerPage = 10;
        $MerchandisePaginate = Merchandise::OrderBy('created_at', 'desc')->paginate($rowPerPage);

        foreach ($MerchandisePaginate as $Merchandise) {
            if (!is_null($Merchandise->photo)) {
                $Merchandise->photo = url($Merchandise->photo);
            }
        }

        $binding = [
            'title' => '商品管理',
            'MerchandisePaginate' => $MerchandisePaginate
        ];

        return view('merchandise.manageMerchandise', $binding);
    }

    public function merchandiseItemBuyProcess($merchandise_id)
    {
        $input = request()->all();

        $rules = [
            'buyCount' => [
                'required',
                'integer',
                'min:1'
            ]
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect('/merchandise/' . $merchandise_id)->withErrors($validator)->withInput();
        }

        try {
            $userId = session()->get('user_id');
            $User = User::findOrFail($userId);
            $buyCount = $input['buyCount'];
            $merchandise = Merchandise::findOrFail($merchandise_id);

            DB::beginTransaction();

            $remainCountAfterBuy = $merchandise->remain_count - $buyCount;
            if ($remainCountAfterBuy < 0) {
                throw new Exception('商品數量不足無法購買');
            }
            $merchandise->remain_count = $remainCountAfterBuy;
            $merchandise->save();

            $totalPrice = $buyCount * $merchandise->price;
            $transactionData = [
                "user_id" => $userId,
                "merchandise_id" => $merchandise->id,
                "price" => $merchandise->price,
                "buy_count" => $buyCount,
                "total_price" => $totalPrice
            ];
            Transaction::create($transactionData);

            DB::commit();
            $message = [
                'msg' => [
                    '購買成功'
                ]
            ];
            return redirect()->to('/merchandise/'. $merchandise->id)->withErrors($message);
        } catch (Exception $e) {
            DB::rollBack();
            $errorMessage = [
                'msg' => [
                    $e->getMessage()
                ]
            ];
            return redirect()->back()->withErrors($message)->withInput();
        }
    }
}
