<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Shop;
use App\Mail\ReservationConfirmed;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    //予約保存処理
    public function store(ReservationRequest $request)
    {
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
        ]);
        //予約確認メール送信
        Mail::to(auth()->user()->email)->send(new ReservationConfirmed($reservation));

        //予約完了ページへリダイレクト
        return view('shops.done', ['reservation' => $reservation]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('mypage.edit', compact('reservation'));
    }

    //予約更新処理
    public function update(ReservationRequest $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);

        // 予約日時の重複チェック
        $existingReservation = Reservation::where([
            'user_id' => auth()->id(),
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
        ])->where('id', '!=', $id) // 現在の予約を除外
            ->first();

        if ($existingReservation) {
            return back()->with('error', 'その日時にはすでに予約があります');
        }

        $reservation->update([
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'number_of_people' => $request->input('number_of_people'),
        ]);

        Mail::to(auth()->user()->email)->send(new ReservationConfirmed($reservation));

        return redirect()->route('profile.index')->with('message', '予約を変更しました');
    }

    //予約削除処理
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->delete();

        return back()->with('message', '予約を削除しました');
    }
}
