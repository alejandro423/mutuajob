<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'user_one_id',
        'user_two_id'
    ];

    // usuario 1
    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    // usuario 2
    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    // mensajes de esta conversación
    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }
}