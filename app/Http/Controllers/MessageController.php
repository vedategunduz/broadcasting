<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return view('message.index');
    }

    public function store(Request $request)
    {
        $validated = $request->all();

        $message = User::find(Auth::id())->messages()->create($validated);

        broadcast(new MessageCreated($message))->toOthers();

        return response()->json([
            'success' => true,
            'message_id' => $message->id,
        ], 201);
    }
}
