<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Reservation;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        $reservation = Reservation::find($request->reservation_id);
        if ($reservation->status === 'completed' && $reservation->reservation_date < now()) {
            Review::create([
                'user_id' => auth()->id(),
                'shop_id' => $reservation->shop_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return back()->with('message', 'レビューを投稿しました');
        }
        return back();
    }

    public function create(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);
        $review = Review::where('user_id', auth()->id())
            ->where('shop_id', $reservation->shop_id)
            ->first();

        // 予約が完了していて、かつ予約日時が現在時刻よりも過去の場合にレビュー投稿画面を表示
        if ($reservation && $reservation->status === 'completed' && $reservation->reservation_date < now()) {
            return view('reviews.create', compact('reservation'));
        }

        return back()->with('error', 'レビューを投稿できません');
    }
}
