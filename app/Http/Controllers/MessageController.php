<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\message;


class MessageController extends Controller
{
    public function index()
    {
        // DBよりmessageテーブルの値を全て取得する
        $message_array = message::all()->toAllay();

        return view('index',compact('message_array'));
    }

    public function edit($id)
    {
        # code...
    }

}
