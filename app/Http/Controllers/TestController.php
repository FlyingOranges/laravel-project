<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function test()
    {
        $token = request()->header('Authorization');

        dd(strlen(bcrypt($token)));
    }

    public function index()
    {
        dd('小楼一夜听春雨');
    }
}
