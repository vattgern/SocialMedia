<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function all(){
        return Message::all();
    }
    public function index($id){
        return Message::find($id);
    }
    public function store(Request $request){
        $message = Message::create([
            'user_id' => Auth::user()->id,
            'room_id' => $request->input('room_id'),
            'message' => $request->input('message'),
        ]);
        return response()->json([
           'message' => 'сообщение отправлено',
            'data' => $message
        ]);
    }
    public function destroy($id){
        $message = Message::find($id);
        $message->delete();
        return response()->json([
           'message' => 'сообщение удалено',
        ]);
    }
}
