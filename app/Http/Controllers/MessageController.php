<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages');
    }

    public function show()
    {
        $messages = Message::all();

        $html = view('message-body', [
            'messages' => $messages
        ])->render();

        return response()->json([
            'html' => $html
        ]);
    }

    public function store(Request $request)
    {

        Message::create($request->all());

        $messages = Message::all();

        $html = view('message-body', [
            'messages' => $messages
        ])->render();

        return response()->json([
            'html' => $html
        ]);
    }
}
