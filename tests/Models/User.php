<?php

namespace HPWebdeveloper\LaravelPayPocket\Tests\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use HPWebdeveloper\LaravelPayPocket\Interfaces\WalletOperations;
use HPWebdeveloper\LaravelPayPocket\Traits\ManagesWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements WalletOperations
{
    use HasFactory;
    use ManagesWallet;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
}
