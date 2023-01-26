<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Friend;
use App\Models\User;
use App\Models\UserCategory;
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
    public function addCategory(Request $request){
        $categories = $request->input('categories');
        if($categories){
            foreach ($categories as $category) {
                UserCategory::create([
                    'category_id' => $category,
                    'user_id' => Auth::id(),
                ]);
            }
        }
    }
    public function getCategoriesM(){
        $categories = UserCategory::all()->where('user_id', Auth::id());
        $arr = [];
        foreach ($categories as $category){
            $arr[] = $category;
        }
        return response()->json([
            'message' => 'Выбранные категории',
            'data' => $arr
        ]);
    }
}
