<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoom extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function userSecond(){
        return $this->belongsTo(User::class, 'user_second_id');
    }
}
