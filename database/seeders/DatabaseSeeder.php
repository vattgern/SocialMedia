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
use Illuminate\Testing\Fluent\Concerns\Has;

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
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('4587'),
            'avatar' => '/default-avatar.png',
            'background' => '/img/cover-profile.png'
        ]);
        User::factory()->create([
            'name' => 'Лиджиев Александр',
            'email' => 'sashawot060@gmail.com',
            'password' => Hash::make('4587'),
            'avatar' => '/default-avatar.png',
            'background' => '/img/cover-profile.png'
        ]);
        $category = Category::factory()->create([
            'name' => 'Спорт',
        ]);
        Category::factory()->create([
            'name' => 'Игры',
        ]);
        Category::factory()->create([
            'name' => 'Фильмы',
        ]);
        Category::factory()->create([
            'name' => 'Музыка',
        ]);

        Post::factory()->count(5)->create([
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);
    }
}
