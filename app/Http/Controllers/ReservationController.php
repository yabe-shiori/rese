<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Order;
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

        Mail::to(auth()->user()->email)->send(new ReservationConfirmed($reservation));

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

        $existingReservation = Reservation::where([
            'user_id' => auth()->id(),
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
        ])->where('id', '!=', $id)
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

        $isPaidReservation = Order::where('reservation_id', $reservation->id)->exists();

        if ($isPaidReservation) {
            return back()->with('error', '支払い済みの予約は削除できません。');
        }

        $reservation->delete();

        return back()->with('message', '予約が正常に削除されました');
    }
}
