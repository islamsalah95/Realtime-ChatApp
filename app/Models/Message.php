<?php

namespace App\Models;

use App\Models\Friend;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
            'message',
            'user_id',
            'friend_id',
            'created_at',
            'updated_at',
    ];

    public function friendroom()
    {
        return $this->belongsTo(Friend::class,'friend_id');
    }
}
