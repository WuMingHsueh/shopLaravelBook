<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function signUpPage()
    {
        $binding = [
            'title' => '註冊'
        ];
        return view('auth.signUp', $binding);
    }

    public function signUpProcess()
    {
        $input = request()->all();
        var_dump($input);
        exit;
    }
}
