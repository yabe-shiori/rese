<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Shop;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    //予約保存処理
    public function store(ReservationRequest $request)
    {
        //ログインチェック
        if (!auth()->check()) {
            return back()->with('error', 'ログインしてください');
        }
        //予約日時の重複チェック
        $existingReservation = Reservation::where([
            'user_id' => auth()->id(),
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
        ])->first();

        if ($existingReservation) {
            return back()->with('error', 'その日時にはすでに予約があります');
        }

        $shop = Shop::findOrFail($request->input('shop_id'));

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'shop_id' => $shop->id,
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'number_of_people' => $request->input('number_of_people'),
            // 'status' => 'completed',
        ]);
        return view('shops.done', ['reservation' => $reservation->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('mypage.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationRequest $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);

        // 予約日時の重複チェック
        $existingReservation = Reservation::where([
            'user_id' => auth()->id(),
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
        ])->where('id', '!=', $id) // 現在の予約を除外する
            ->first();

        if ($existingReservation) {
            return back()->with('error', 'その日時にはすでに予約があります');
        }

        $reservation->update([
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'number_of_people' => $request->input('number_of_people'),
            // 'status' => 'completed',
        ]);

        return redirect()->route('profile.index')->with('message', '予約を変更しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->delete();

        return back()->with('message', '予約を削除しました');
    }
}
