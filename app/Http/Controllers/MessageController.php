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
        // imeage file
        if( !empty($request->image_file) )
        {
            // validation
            $this->validate($request, [
                'image_file' => [
                    // アップロードされたファイルであること
                    'file',
                    // 画像ファイルであること
                    'image',
                    // MIMEタイプを指定
                    'mimes:jpeg,png',
                ]
            ]);

            // get file name
            $fileNameWithExt = $request->file('image_file')->getClientOriginalName();

            // get just the file name
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);

            // get extension
            $extension = $request->file('image_file')->getClientOriginalExtension();

            // create new file
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            // Store to Storage
            $path =$request->file('image_file')->storeAs('public/image',$filenameToStore);

            $message->image_file_name = $filenameToStore;
            $message->file_path = $path;
        }
        $message->save();

        return redirect('/index')->with('flash_message', '投稿が完了しました');
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

        return redirect('/index')->with('flash_message', '投稿を編集しました');

    }

    public function destroy($post_id)
    {
        $message= message::findOrFail($post_id);
        $message->delete();

        return redirect('/index')->with('flash_message', '投稿を削除しました
        ');
    }

    public function show($post_id)
    {
        $post = message::findOrFail($post_id);
        
        return view('show',compact('post'));
    }
}
