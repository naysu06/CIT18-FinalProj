<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Ensure password is hashed when creating or updating
    protected $casts = [
        'password' => 'hashed',
    ];

    // Method to check if the user is an admin
    
    public function isAdmin()
    {
        return $this->role === 'admin'; // Check if the user's role is 'admin'
    }
    
    // Use username instead of email for login
    public function username()
    {
        return 'username';
    }
}
