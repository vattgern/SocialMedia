<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRoomResource;
use App\Models\UserRoom;

class UserRoomController extends Controller
{
    public function index($id){
        return new UserRoomResource(UserRoom::find($id));
    }
}
