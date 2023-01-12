<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;

class RoomController extends Controller
{
    public function all(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return RoomResource::collection(Room::all());
    }
    public function index($id): RoomResource
    {
        return new RoomResource(Room::find($id));
    }
}
