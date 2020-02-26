<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\message;


class MessageController extends Controller
{
    public function index()
    {
        // DBよりmessageテーブルの値を全て取得する
        $message_array = message::latest()->get();

        return view('index',compact('message_array'));
    }

    public function store(Request $request)
    {
        $message = new Message;
        $message->view_name = $request->view_name;
        $message->message = $request->message;
        $message->save();

        return redirect('/')->with('flash_message', '投稿が完了しました');
    }
}
