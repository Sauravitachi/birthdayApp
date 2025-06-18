<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'city',
        'country',
        'occupation',
        'status',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Accessor to get age from date_of_birth.
     *
     * @return string|null
     */
    public function getAgeAttribute()
    {
        if (!$this->date_of_birth) {
            return null;
        }

        $age = $this->date_of_birth->age;

        return $age === 0 ? '< 1' : $age;
    }
}
