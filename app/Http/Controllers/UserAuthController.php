<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Mail;
use App\Shop\Entity\User;
use App\Jobs\SendSignUpMailJob;

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
        // 驗證表單格式
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect('/user/auth/sign-up')->withErrors($validator)->withInput();
        }

        //已註冊帳號處理
        if (!is_null(User::where('email', $input['email']))) {
            $message = [
                'msg' => [
                    $input['email'] . " 已存在"
                ]
            ];
            return redirect('/user/auth/sign-up')->withErrors($message)->withInput();
        }

        // 密碼編碼並寫入資料庫
        $input['password'] = Hash::make($input['password']);
        $Users = User::create($input);

        // 寄送註冊信
        $mailBinding = [ 
            'nickname' => $input['nickname'],
            'email'    => $input['email']
        ];
        SendSignUpMailJob::dispatch($mailBinding);
        return redirect('/user/auth/sign-in');
    }

    public function signInPage() 
    {
        $binding = [
            'title' => '登入'
        ];
        return view('auth.signIn', $binding);
    }

    public function signInProcess() 
    {
        $input = request()->all();
        $rules = [
            'email' => [
                'required',
                'max:150',
                'email'
            ],
            'password' => [
                'required',
                'min:6'
            ]
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect('/user/auth/sign-in')->withErrors($validator)->withInput();
        }

        $User = User::where('email', $input['email'])->firstOrFail();
        if (!Hash::check($input['password'], $User->password)) 
        {
            $errorMessage = [
                'msg' => [
                    '密碼驗證錯誤'
                ]
            ];
            return redirect('/user/auth/sign-in')->withErrors($errorMessage)->withInput();
        }

        session()->put('user_id', $User->id);
        return redirect()->intended('/');
    }

    public function signOutProcess()
    {
        session()->forget('user_id');
        return redirect('/');
    }
}
