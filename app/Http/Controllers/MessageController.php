<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;
use DB;

class MessageController extends Controller
{
    public function index(Request $request)
    {   
        $user_id = Auth::user()->id;
        $contact_id = $request->contact_id;

        return Message::select('id', 'from_id', 'content', 'created_at', DB::raw("IF(`from_id`=$user_id, TRUE, FALSE) as from_me"))
        ->where(function ($query) use ($user_id, $contact_id) {
            $query->where('from_id', $user_id)->where('to_id', $contact_id);
        })
        ->orWhere(function ($query) use ($user_id, $contact_id) {
            $query->where('from_id', $contact_id)->where('to_id', $user_id);
        })
        ->get();
    }

    public function store(Request $request) 
    {
        $message = Message::create([
            'from_id' => Auth::user()->id,
            'to_id' => $request->to_id,
            'content' => $request->content
        ]);

        $result = [];
        $result['message'] = $message;
        $result['success'] = $message->exists();

        return $result;
    }
}
