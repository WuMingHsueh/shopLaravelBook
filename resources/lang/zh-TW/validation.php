<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => '必須接受 :attribute',
    'active_url'           => ':attribute 並非一個有效的網址。',
    'after'                => ':attribute 必須要在 :date 之後',
    'after_or_equal'       => ':attribute 必須要與 :date 相同或之後',
    'alpha'                => ':attribute 只能以字母組成',
    'alpha_dash'           => ':attribute 只能以字母、數字及斜線組成',
    'alpha_num'            => ':attribute 只能以字母、數字組成',
    'array'                => ':attribute 只能是陣列',
    'before'               => ':attribute 必須要在 :date 之前',
    'before_or_equal'      => ':attribute 必須要與 :date 相同或之前',
    'between'              => [
        'numeric' => ':attribute 須介於 :min 與 :max 之間',
        'file'    => ':attribute 須介於 :min 與 :max kb 之間',
        'string'  => ':attribute 須介於 :min 與 :max 個字元之間',
        'array'   => ':attribute 須介於 :min 與 :max 個元素',
    ],
    'boolean'              => ':attribute 須為bool值',
    'confirmed'            => ':attribute 確認欄位輸入並不相符',
    'date'                 => ':attribute 並非一個有效時間格式',
    'date_format'          => ':attribute 與 :format 格式不合',
    'different'            => ':attribute 與 :other 須不相同',
    'digits'               => ':attribute 須是 :digits 位數字',
    'digits_between'       => ':attribute 須介於 :min 與 :max 位數字之間',
    'dimensions'           => ':attribute has invalid image dimensions.',
    'distinct'             => ':attribute 已經存在',
    'email'                => ':attribute 須為合法email格式',
    'exists'               => '所選擇的 :attribute 選項無效',
    'file'                 => ':attribute 須為檔案',
    'filled'               => ':attribute 欄位不可為空',
    'image'                => ':attribute 須為圖片格式',
    'in'                   => '所選擇的 :attribute 選項無效',
    'in_array'             => ':attribute 沒有在 :other 陣列之中',
    'integer'              => ':attribute 須為整數數字',
    'ip'                   => ':attribute 須為合法ip格式',
    'ipv4'                 => ':attribute 須為合法ipv4格式',
    'ipv6'                 => ':attribute 須為合法ipv6格式',
    'json'                 => ':attribute 須為合法json格式',
    'max'                  => [
        'numeric' => ':attribute 不能大於 :max.',
        'file'    => ':attribute 檔案大小不能大於 :max kb',
        'string'  => ':attribute 不能多於 :max 個字元數',
        'array'   => ':attribute 最多有 :max 元素',
    ],
    'mimes'                => ':attribute 須為 :values 的檔案',
    'mimetypes'            => ':attribute 須為 :values 的檔案',
    'min'                  => [
        'numeric' => ':attribute 不能小於 :min.',
        'file'    => ':attribute 檔案大小不能小於 :min kb',
        'string'  => ':attribute 不能多於 :min 個字元數',
        'array'   => ':attribute 最多有 :min 元素',
    ],
    'not_in'               => '所選擇的 :attribute 選項無效',
    'numeric'              => ':attribute 須為一個數字',
    'present'              => ':attribute 須存在',
    'regex'                => ':attribute 格式不和',
    'required'             => ':attribute 不能為空',
    'required_if'          => '當 :other 是 :value 時 :attribute 此欄位不能為空',
    'required_unless'      => '當 :other 非 :value 時 :attribute 此欄位不能為空',
    'required_with'        => '當 :values 出現時 :attribute 不可為空',
    'required_with_all'    => '當 :values 出現時 :attribute 不可為空',
    'required_without'     => '當 :values 為空時 :attribute 不可為空',
    'required_without_all' => '當 :values 為空時 :attribute 不可為空',
    'same'                 => ':attribute 與 :other 須相同',
    'size'                 => [
        'numeric' => ':attribute 的大小須為 :size.',
        'file'    => ':attribute 檔案的大小須為 :size kb',
        'string'  => ':attribute 須是 :size 個字元',
        'array'   => ':attribute 須是 :size 個元素',
    ],
    'string'               => ':attribute 須是一組字串',
    'timezone'             => ':attribute 須為正確的時區格式',
    'unique'               => ':attribute 已存在',
    'uploaded'             => ':attribute 上傳失敗',
    'url'                  => ':attribute 格式錯誤',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'nickname'              => '暱稱',
        'email'                 => '電子信箱',
        'password'              => '密碼',
        'password_confirmation' => '確認密碼'
    ],

];
