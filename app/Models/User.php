<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Perfil;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'estado',
        'google2fa_secret',
        'google2fa_enabled'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function hasRole(string $role)
    {
        return $this->roles()->where('nombre', $role)->exists();
    }
    public function perfil()
{
    return $this->hasOne(Perfil::class);
}
public function conversations()
{
    return Conversation::where('user_one_id', $this->id)
        ->orWhere('user_two_id', $this->id);
}
public function messages()
{
    return $this->hasMany(Message::class, 'sender_id');
}
}