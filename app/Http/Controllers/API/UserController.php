<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function all(){
        return UserResource::collection(User::all());
    }
    public function show($id){
        return new UserResource(User::find($id));
    }
    public function friendRequest(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        $friends = Friend::all()->where('friend_id', Auth::user()->id)->where('status', 0);
        return response()->json([
            'data' => $friends,
            'message' => 'Заявки в друзья',
        ]);
    }
    public function submitFriendRequest($id){
        $friends = Friend::find($id);
        $friends->update([
           'status' => 1
        ]);
        Friend::create([
            'user_id' => Auth::user()->id,
            'friend_id' => $friends->friend_id,
            'status' => 1
        ]);
        return response()->json([
            'message' => 'Заявка принята',
        ]);
    }
}
