<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeCtrl extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
