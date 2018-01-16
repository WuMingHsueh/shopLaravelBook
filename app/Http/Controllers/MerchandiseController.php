<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop\Entity\Merchandise;
use Validator;

class MerchandiseController extends Controller
{
    public function merchandiseListPage()
    {
        return "merchandise list page";
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
}
