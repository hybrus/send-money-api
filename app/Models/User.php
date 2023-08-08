<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasFactory;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function getAccount(): Account
    {
        if ($this->account()->exists()) {
            return $this->account;
        }

        // If the related profile does not exist, create a new one
        return $this->account()->create(['user_id' => $this->id]);
    }

    public function sentTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'sender_user_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'sender_user_id')
            ->orWhere('recipient_user_id', $this->id);
    }


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
