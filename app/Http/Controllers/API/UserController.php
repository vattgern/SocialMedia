<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function all(){
        return UserResource::collection(User::all());
    }
    public function show($id){
        return new UserResource(User::find($id));
    }
    public function update(Request $request){
        $background = $request->file('background');
        $avatar = $request->file('avatar');
        $user = User::find(Auth::id());

        if($background){
            $backgroundPath = Storage::disk('public')->put('backgrounds', $background);
            $user->update([
                'background' => '/storage/'.$backgroundPath,
            ]);
        }
        if($avatar){
            $avatarPath = Storage::disk('public')->put('avatars', $avatar);
            $user->update([
                'avatar' => '/storage/'.$avatarPath,
            ]);
        }
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'city' => $request->input('city'),
        ]);
        return response()->json([
            'message' => 'Пользователь обновлен'
        ]);
    }
}
