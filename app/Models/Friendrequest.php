<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friendrequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id_sender',
        'user_id_recieved',
        'sendername',
        'recievedname',
        'created_at',
        'updated_at',

    ];


    public function sender()
    {
        return $this->belongsTo(User::class,'id','user_id_sender');
    }


    public function recieved()
    {
        return $this->belongsTo(User::class,'id','user_id_recieved');
    }
}
