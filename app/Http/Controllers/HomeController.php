<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // DBよりmessageテーブルの値を全て取得する
        $message_array = message::latest()->get();
        //return view('home');
        return view('index',compact('message_array'));
    }
}
