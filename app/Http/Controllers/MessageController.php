<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\index;

class MessageController extends Controller
{
    // DBよりmessageテーブルの値を全て取得
    $message_array = message::all();

    return view('index', compact('message_array'));
}
