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
        return $this->search($request);
    }

    // 詳細表示
    public function detail($shop_id)
    {
        $shop = Shop::with('area', 'genre', 'dishes', 'reviews.reviewImages')->findOrFail($shop_id);

        $reviews = $shop->reviews()->with('reviewImages')->latest()->get();

        $satisfactions = [];

        foreach ($reviews as $review) {
            $satisfactions[$review->id] = $this->getSatisfaction($review->rating);
        }

        return view('shops.show', compact('shop', 'reviews', 'satisfactions'));
    }

    // 評価に対する満足度を返す
    public function getSatisfaction($rating)
    {
        switch ($rating) {
            case 5:
                return '非常に満足';
            case 4:
                return '大変満足';
            case 3:
                return '満足';
            case 2:
                return 'やや不満';
            case 1:
                return '不満';
            default:
                return '';
        }
    }

    // 検索
    public function search(Request $request)
    {
        $sortBy = $request->input('sort_by', 'random');
        $area = $request->input('area');
        $genre = $request->input('genre');
        $name = $request->input('name');

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
                $query->inRandomOrder();
                break;
        }

        $query = $this->applyFilters($query, $area, $genre, $name);

        $results = $query->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('shops.index', compact('results', 'areas', 'genres'));
    }

    private function applyFilters($query, $area, $genre, $name)
    {
        if ($area) {
            $query->where('area_id', $area);
        }

        if ($genre) {
            $query->where('genre_id', $genre);
        }

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return $query->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')
            ->select('shops.*')
            ->groupBy('shops.id')
            ->orderByRaw('ISNULL(AVG(reviews.rating))');
    }
}
