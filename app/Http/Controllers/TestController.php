<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function test()
    {
        $UserModel = new UserModel();

        $result = $UserModel->login('xiaofeng');
        dd($result);
    }
}
