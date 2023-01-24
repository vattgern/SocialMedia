<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function participants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserRoom::class, 'room_id', 'id');
    }
    public function messages(){
        return $this->hasMany(Message::class, 'room_id', 'id');
    }
}
