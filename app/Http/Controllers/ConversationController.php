<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;

class ConversationController extends Controller
{
    public function index()
    {
        // $conversations = \Auth::user()->conversations;
        // return response()->json($conversations, 200);

        return Conversation::where('user_id', auth()->user()->id)
        // ->with('contact:id,name')
        ->select('id', 'contact_id', 'last_message', 'last_time', 'has_blocked', 'listen_notifications')
        ->get();
    }
}
