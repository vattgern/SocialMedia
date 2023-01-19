<?php

namespace App\Http\Controllers\API\Chat;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Message;
use App\Models\Room;
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
    public function getMessages($id){
        return new RoomResource(Room::find($id));
    }
    public function store(Request $request){
        $user = Auth::user();
        $message = Message::create([
            'user_id' => $user->id,
            'room_id' => $request->input('room_id'),
            'message' => $request->input('message'),
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

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
