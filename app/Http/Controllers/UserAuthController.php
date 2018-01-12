<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

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
        $rules = [
            'nickname' => [
                'required',
                'max:50',
            ],
            'email' => [
                'required',
                'max:150',
                'email',
            ],
            'password' => [
                'required',
                'same:password_confirmation',
                'min:6',
            ],
            'password_confirmation' => [
                'required',
                'min:6',
            ],
            'type' => [
                'required',
                'in:G,A',
            ]
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect('/user/auth/sign-up')->withErrors($validator);
        }
    }
}
