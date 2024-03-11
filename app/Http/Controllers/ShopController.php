<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'random');

        $query = Shop::query();

        switch ($sortBy) {
            case 'high_rating':
                $query->orderByRaw('IFNULL(AVG(reviews.rating), 0) DESC');
                break;
            case 'low_rating':
                $query->orderByRaw('IFNULL(AVG(reviews.rating), 5) ASC');
                break;
            case 'random':
            default:
                $query->orderByRandom();
                break;
        }

        $query->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')
            ->select('shops.*')
            ->groupBy('shops.id')
            ->orderByRaw('ISNULL(AVG(reviews.rating))');

        $shops = $query->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('shops.index', compact('shops', 'areas', 'genres'));
    }

    //詳細表示
    public function detail($shop_id)
    {
        $shop = Shop::with('area', 'genre', 'dishes')->findOrFail($shop_id);
        return view('shops.show', compact('shop'));
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
