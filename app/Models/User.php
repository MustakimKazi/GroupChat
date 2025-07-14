<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ This one is needed
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // ✅ Fix this line
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image',
    ];


    public function messages()
{
    return $this->hasMany(Message::class);
}


}
