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
    public function create()
    {
        // ログイン中のユーザーの過去の完了した予約を取得する
        $reservations = Reservation::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->where('reservation_date', '<', now())
            ->with('shop') // shopリレーションも一緒にロードする
            ->orderBy('reservation_date', 'desc')
            ->get();

        // ビューに予約情報を渡してレンダリングする
        return view('reviews.create', compact('reservations'));
    }

}
