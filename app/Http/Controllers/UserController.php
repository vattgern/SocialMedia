<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
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
