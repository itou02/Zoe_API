<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $message = Message::create([
            'content' => $request->input('content'),
        ]);

        return response()->json($message, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $message = Message::findOrFail($id);
        $message->update([
            'content' => $request->input('content'),
        ]);

        return response()->json($message);
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return response()->json(null, 204);
    }
}