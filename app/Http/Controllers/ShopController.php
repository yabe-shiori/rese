<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Review;


class ShopController extends Controller
{
    //一覧表示
    public function index()
    {
        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();

        return view('shops.index', compact('shops', 'areas', 'genres'));
    }

    //詳細表示
    public function detail($shop_id)
    {
        $shop = Shop::with('area', 'genre', 'dishes')->findOrFail($shop_id);
        $reviews = Review::where('shop_id', $shop_id)->get();
        return view('shops.show', compact('shop', 'reviews'));
    }
    
    //検索
    public function search(Request $request)
    {
        $area = $request->input('area');
        $genre = $request->input('genre');
        $name = $request->input('name');

        $results = Shop::query()
            ->when($area, fn ($query, $area) => $query->searchByArea($area))
            ->when($genre, fn ($query, $genre) => $query->searchByGenre($genre))
            ->when($name, fn ($query, $name) => $query->searchByName($name))
            ->get();

        $areas = Area::all();
        $genres = Genre::all();

        return view('shops.index', compact('results', 'areas', 'genres'));
    }
}
