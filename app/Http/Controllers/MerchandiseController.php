<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop\Entity\Merchandise;

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
        if (!is_null($merchandise->photo)) 
        {
            $merchandise->photo = url($merchandise->photo);
        }

        $binding = [
            'title' => '編輯商品',
            'Merchandise' => $merchandise
        ];
        return view('merchandise.editMerchandise', $binding);
    }
}
