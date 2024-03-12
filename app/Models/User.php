<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function favoriteShops()
    {
        return $this->belongsToMany(Shop::class, 'favorites')->withTimestamps();
    }

    public function hasFavorited(Shop $shop)
    {
        return $this->favoriteShops()->where('shop_id', $shop->id)->exists();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function shop()
    {
        return $this->hasOne(Shop::class, 'manager_id');
    }
}
