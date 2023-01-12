<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Message;
use App\Models\Post;
use App\Models\Room;
use App\Models\User;
use App\Models\UserRoom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $userOne = User::factory()->create([
           'name' => 'alex',
           'email' => 'sashawot060@gmail.com',
            'password' => Hash::make('4587'),
            'avatar' => 'default',
            'category' => 'default',
        ]);
        $userTwo = User::factory()->create([
            'name' => 'zirael',
            'email' => 'sasha@gmail.com',
            'password' => Hash::make('4587'),
            'avatar' => 'default',
            'category' => 'default',
        ]);
        $room = Room::factory()->create([
            'name' => 'Alex&Zirael',
            'type' => true,
        ]);
        UserRoom::factory()->create([
            'user_id' => $userOne->id,
            'room_id' => $room->id,
        ]);
        UserRoom::factory()->create([
            'user_id' => $userTwo->id,
            'room_id' => $room->id,
        ]);
        Message::factory()->create([
            'user_id' => $userOne->id,
            'room_id' => $room->id,
            'message'=> 'some text'
        ]);
        Message::factory()->create([
            'user_id' => $userTwo->id,
            'room_id' => $room->id,
            'message'=> 'some text'
        ]);
    }
}
