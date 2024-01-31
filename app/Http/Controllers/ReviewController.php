<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Reservation;
use App\Models\Shop;

class ReviewController extends Controller
{
    // レビュー投稿処理
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $reservation = Reservation::find($request->reservation_id);

        $reviewExists = Review::where('user_id', auth()->id())
            ->where('shop_id', $reservation->shop_id)
            ->first();

        if (!$reviewExists && $reservation->reservation_date < now()) {
            Review::create([
                'user_id' => auth()->id(),
                'shop_id' => $reservation->shop_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return redirect()->back()->with('message', 'レビューを投稿しました');
        }

        return redirect()->back()->with('error', '既にレビューを投稿しています');
    }


    // レビュー投稿画面表示
    public function create()
    {
        $userReservations = Reservation::where('user_id', auth()->id())
            ->with('shop')
            ->orderBy('reservation_date', 'desc')
            ->get();

        $pastReservations = $userReservations->filter(function ($reservation) {
            return $reservation->isPast();
        });

        $reviewedShopIds = Review::where('user_id', auth()->id())
            ->pluck('shop_id')
            ->toArray();

        $filteredPastReservations = $pastReservations->reject(function ($reservation) use ($reviewedShopIds) {
            return in_array($reservation->shop_id, $reviewedShopIds);
        });

        return view('reviews.create', compact('filteredPastReservations'));
    }


    // レビュー詳細画面表示
    public function show(Shop $shop)
    {
        $reviews = Review::where('shop_id', $shop->id)
        ->orderByDesc('created_at')
        ->paginate(5);

        return view('reviews.show', compact('shop', 'reviews'));
    }
}
