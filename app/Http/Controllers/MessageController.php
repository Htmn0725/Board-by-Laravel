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
        $validatedRequest = $request->validate([
            'view_name' => 'required|max:100',
            'message' => 'required|max:100',
        ]);

        $message = new Message;
        $message->view_name = $request->view_name;
        $message->message = $request->message;
        $message->save();

        return redirect('/')->with('flash_message', '投稿が完了しました');
    }

    public function edit($post_id)
    {
        $post = message::findOrFail($post_id);

        return view('edit',['post' => $post,
        ]);
    }

    public function update($post_id, Request $request)
    {
        $validatedRequest = $request->validate([
            'view_name' => 'required|max:100',
            'message' => 'required|max:100',
        ]);

        $message = message::findOrFail($post_id);
        $message->message = $request->message;
        $message->save();

        return redirect('/')->with('flash_message', '投稿を編集しました');

    }

    public function destroy($post_id)
    {
        $message= message::findOrFail($post_id);
        $message->delete();

        return redirect('/')->with('flash_message', '投稿を削除しました
        ');
    }
}
