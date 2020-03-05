<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\message;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'message_id' => 'required|exists:message,id',
            'comment' => 'required|max:100',
        ]);

        $message = message::findOrFail($validatedRequest['message_id']);
        $message->comments()->create($validatedRequest);

        return redirect()->route('posts.show', $message->id);
    }
}
