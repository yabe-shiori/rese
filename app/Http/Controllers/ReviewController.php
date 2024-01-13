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
        $userReservations = Reservation::where('user_id', auth()->id())
            ->with('shop')
            ->orderBy('reservation_date', 'desc')
            ->get();

        $pastReservations = $userReservations->filter(function ($reservation) {
            return $reservation->isPast();
        });

        return view('reviews.create', compact('pastReservations'));

    }

}
