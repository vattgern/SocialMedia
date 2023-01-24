<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Room;
use App\Models\User;
use App\Models\UserRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\String\Inflector\FrenchInflector;

class FriendController extends Controller
{
    public function all(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => Friend::all()->where('user_id', Auth::user()->id),
            'message' => 'Список друзей',
        ]);
    }
    public function index($id): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'friend' => Friend::where(['user_id' => Auth::user()->id, 'friend_id' => $id])->get(),
            'friend_data' => User::find($id),
        ]);
    }
    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        if(Auth::user()->id == $request->input('friend_id')){
            return response()->json([
               'message' => 'Вы не можете добавить друга самого себя',
            ]);
        } else {
            Friend::create([
                'user_id' => Auth::user()->id,
                'friend_id' => $request->input('friend_id'),
                'status' => true,
            ]);
            Friend::create([
               'user_id' => $request->input('friend_id'),
               'friend_id' => Auth::user()->id,
               'status' => false,
            ]);
            return response()->json([
               'message' => 'Заявка отправлена',
               'friend' => User::find($request->input('friend_id'))
            ]);
        }
    }
    public function submitRequest($id): \Illuminate\Http\JsonResponse
    {
        $friend = Friend::find($id);

        $room = Room::create([
           'name' => 'some',
            'type' => true,
        ]);
        UserRoom::create([
            'user_id' => Auth::user()->id,
            'room_id' => $room->id,
        ]);
        UserRoom::create([
           'user_id' => $friend['friend_id'],
            'room_id' => $room->id,
        ]);
        return response()->json([
            'message' => 'Заявка одобрена, комната создана'
        ]);
    }
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $friend = Friend::where('friend_id',$id)->where('user_id', Auth::user()->id);
        $friend->delete();
        $friend = Friend::where('friend_id', Auth::user()->id)->where('user_id', $id);
        $friend->delete();
        return response()->json([
            'message' => 'Друг удален'
        ]);
    }
}
