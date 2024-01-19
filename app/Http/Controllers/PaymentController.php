<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // フォームから送信されたデータを取得
        $reservationId = $request->input('reservation_id');
        $userId = $request->input('user_id');
        $stripeToken = $request->input('stripe_token');
        $amount = $request->input('amount'); // この部分は必要に応じて調整

        // Stripeのキーを設定
        Stripe::setApiKey(config('services.stripe.secret'));

        // Stripeでの支払いを試行
        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'JPY',
                'description' => 'Reservation Payment',
                'source' => $stripeToken,
            ]);

            // データベースに支払い情報を保存
            $payment = new Payment([
                'reservation_id' => $reservationId,
                'user_id' => $userId,
                'stripe_charge_id' => $charge->id,
                'status' => 'succeeded',
                'amount' => $amount / 100, // Stripeの金額は通常セント単位のため、必要に応じて変換
            ]);

            $payment->save();

            // 成功した場合の処理（例: ユーザーに成功メッセージを表示する、リダイレクトするなど）
            return redirect()->route('success.page')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            // エラーが発生した場合の処理（例: エラーメッセージを表示する、エラーログを記録するなど）
            return back()->with('error', $e->getMessage());
        }
    }
}
