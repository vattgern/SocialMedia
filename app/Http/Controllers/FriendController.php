<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function all()
    {
        return Friend::all()->where('user_id', Auth::user()->id);
    }
    public function index($id)
    {
        return Friend::where([
            'user_id' => Auth::user()->id,
            'friend_id' => $id
        ])->get();
    }
    public function add(Request $request)
    {
        Friend::create([
            'user_id' => Auth::user()->id,
            'friend_id' => $request->input('friend_id'),
        ]);
    }
    public function destroy($id)
    {
        $friend = Friend::where('friend_id',$id)->where('user_id', Auth::user()->id);
        $friend->delete();
        return "Друг удален";
    }
}
