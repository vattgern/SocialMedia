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
}
