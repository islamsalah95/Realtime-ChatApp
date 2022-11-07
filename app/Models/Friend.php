<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friend extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id_sender',
        'user_id_recieved',
        'sender_name',
        'recieved_name',
        'created_at',
        'updated_at',
    ];


    public function messages()
    {
        return $this->hasMany(Message::class,'friend_id');
    }
}
