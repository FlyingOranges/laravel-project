<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function test()
    {
        $token = request()->header('Authorization');

        dd($token);
    }
}
