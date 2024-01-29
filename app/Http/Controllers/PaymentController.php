<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Payment;
use App\Models\StripeCustomer;
use App\Models\Reservation;

class PaymentController extends Controller
{

    //支払いページ表示
    public function index(Request $request)
    {
        $reservationId = $request->input('reservation_id');
        $reservation = Reservation::find($reservationId);

        $dish = Dish::where('shop_id', $reservation->shop_id)->get();

        return view('payment.index', ['reservation' => $reservation, 'menu' => $dish]);
    }

    //支払い
    public function store(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $orderQuantities = $request->input('quantity');
        $dishes = Dish::find(array_keys($orderQuantities));

        $amount = $dishes->sum(function ($dish) use ($orderQuantities) {
            $quantity = isset($orderQuantities[$dish->id]) && is_numeric($orderQuantities[$dish->id]) ? $orderQuantities[$dish->id] : 0;
            return $dish->price * $quantity;
        });

        if ($amount <= 0) {
            return view('payment.error', ['error' => 'Invalid amount']);
        }

        $stripeCustomer = StripeCustomer::firstOrCreate(
            ['user_id' => $request->user()->id],
            ['stripe_customer_id' => $this->createStripeCustomer($request->user())->id]
        );

        try {
            $paymentIntent = $this->createPaymentIntent($amount, $stripeCustomer);

            foreach ($orderQuantities as $dishId => $quantity) {
                if (!is_numeric($quantity) || $quantity <= 0) {
                    continue;
                }

                $reservationId = $request->input('reservation_id');

                Order::create([
                    'user_id' => $request->user()->id,
                    'dish_id' => $dishId,
                    'quantity' => $quantity,
                    'reservation_id' => $reservationId,
                ]);
            }

            $status = $paymentIntent->status === 'succeeded' ? 'succeeded' : 'failed';

            $payment = Payment::create([
                'user_id' => $request->user()->id,
                'reservation_id' => $request->reservation_id,
                'stripe_charge_id' => $paymentIntent->id,
                'status' => $status,
                'amount' => $amount
            ]);

            return view('payment.success', ['payment' => $payment]);
        } catch (\Exception $e) {
            return view('payment.error', ['error' => $e->getMessage()]);
        }
    }

    private function createStripeCustomer($user)
    {
        return \Stripe\Customer::create([
            'email' => $user->email,
        ]);
    }

    private function createPaymentIntent($amount, $stripeCustomer)
    {
        return PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'jpy',
            'customer' => $stripeCustomer->stripe_customer_id,
        ]);
    }
}
