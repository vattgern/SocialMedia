<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendResource;
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
            'data' => FriendResource::collection(Friend::all()->where('user_id', Auth::user()->id)->where('status', 1)),
            'message' => 'Список друзей',
        ]);
    }
    public function countFriends(){
        $friends = FriendResource::collection(Friend::all()->where('user_id', Auth::id())->where('status', 1));
        return response()->json([
            'message' => 'Кол-во друзей',
            'count' => $friends->count()
        ]);
    }
//    public function index($id): \Illuminate\Http\JsonResponse
//    {
//        return response()->json([
//            'friend' => Friend::where(['user_id' => Auth::user()->id, 'friend_id' => $id])->get(),
//            'friend_data' => User::find($id),
//        ]);
//    }
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
    public function friendsRequests(): \Illuminate\Http\JsonResponse
    {
        $friends = Friend::all()->where('user_id', Auth::id())->where('status', 0);
        return response()->json([
            'data' => FriendResource::collection($friends),
            'message' => 'Заявки в друзья',
        ]);
    }
    public function submitRequest($id){
        $friends = Friend::find($id);
        $friends->update([
            'status' => 1
        ]);
        $room = Room::create([
            'name' => 'some',
            'type' => true,
        ]);
        UserRoom::create([
            'user_id' => Auth::user()->id,
            'user_second_id' => $friends['friend_id'],
            'room_id' => $room->id,
        ]);
        return response()->json([
            'message' => 'Заявка принята, комната создана',
        ]);
    }
    public function rejectedRequest($id): \Illuminate\Http\JsonResponse
    {
        $friend = Friend::where('friend_id', $id)->where('user_id', Auth::id())->first();
        $friendLineSecond = Friend::where('friend_id', Auth::id())->where('user_id', $id)->first();
        $friend->delete();
        $friendLineSecond->delete();
        return response()->json([
            'message' => 'Заявка отклонена'
        ]);
    }
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $userRoom = UserRoom::where('user_id', $id)->where('user_second_id', Auth::id())->first();
        if($userRoom === null){
            $userRoom = UserRoom::where('user_id', Auth::id())->where('user_second_id', $id)->first();
        }
        $idRoom = $userRoom->room_id;
        $room = Room::find($idRoom);

        $userRoom->delete();
        $room->delete();

        $friend = Friend::where('friend_id',$id)->where('user_id', Auth::user()->id)->first();
        $friend->delete();
        $friend = Friend::where('friend_id', Auth::user()->id)->where('user_id', $id)->first();
        $friend->delete();
        return response()->json([
            'message' => 'Друг удален'
        ]);
    }
}
