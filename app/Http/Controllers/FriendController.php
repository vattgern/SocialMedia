<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ]);
            return response()->json([
               'message' => 'Заявка отправлена',
               'friend' => User::find($request->input('friend_id'))
            ]);
        }
    }
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $friend = Friend::where('friend_id',$id)->where('user_id', Auth::user()->id);
        $friend->delete();
        return response()->json([
            'message' => 'Друг удален'
        ]);
    }
}
