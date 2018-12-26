<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function test()
    {
        $token = request()->header('Authorization');

        dd(strlen(bcrypt($token)));
    }
}
