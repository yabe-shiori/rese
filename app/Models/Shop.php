<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'genre_id',
        'area_id',
        'manager_id',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Shopが所属するManager(User)を取得
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    //検索ロジック
    public function scopeSearchByArea($query, $areaId)
    {
        return $query->where('area_id', $areaId);
    }
    public function scopeSearchByGenre($query, $genreId)
    {
        return $query->where('genre_id', $genreId);
    }

public function scopeSearchByName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

}
