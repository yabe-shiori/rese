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
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    // 支払いページ表示
    public function index(Request $request)
    {
        $reservationId = $request->input('reservation_id');
        $reservation = Reservation::find($reservationId);

        $dish = Dish::where('shop_id', $reservation->shop_id)->get();

        return view('payment.index', ['reservation' => $reservation, 'menu' => $dish]);
    }

    // Webhook
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\Exception $e) {
            Log::error('Webhook Signature Verification Failed: ' . $e->getMessage());
            return response()->json(['error' => 'Webhook Signature Verification Failed'], 403);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event);
                break;
            case 'payment_intent.payment_failed':
                $this->handlePaymentIntentFailed($event);
                break;
            default:
        }
        return response()->json(['status' => 'success']);
    }

    // 支払い
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

        $user = $request->user();

        try {
            $stripeCustomer = $this->createOrUpdateStripeCustomer($user);
            $token = $request->input('stripeToken');
            $paymentIntent = $this->createPaymentIntent($amount, $stripeCustomer, $token);

            foreach ($orderQuantities as $dishId => $quantity) {
                if (!is_numeric($quantity) || $quantity <= 0) {
                    continue;
                }

                $reservationId = $request->input('reservation_id');

                Order::create([
                    'user_id' => $user->id,
                    'dish_id' => $dishId,
                    'quantity' => $quantity,
                    'reservation_id' => $reservationId,
                ]);
            }

            $status = $paymentIntent->status === 'succeeded' ? 'succeeded' : 'failed';

            $payment = Payment::create([
                'user_id' => $user->id,
                'reservation_id' => $request->reservation_id,
                'stripe_charge_id' => $paymentIntent->id,
                'status' => $status,
                'amount' => $amount,
            ]);

            return view('payment.success', ['payment' => $payment]);
        } catch (\Exception $e) {
            return view('payment.error', ['error' => $e->getMessage()]);
        }
    }

    // Stripe 顧客を作成または更新
    private function createOrUpdateStripeCustomer($user)
    {
        $stripeCustomer = StripeCustomer::firstOrCreate(
            ['user_id' => $user->id],
            ['stripe_customer_id' => null]
        );

        if (!$stripeCustomer->stripe_customer_id) {
            $stripeCustomer->stripe_customer_id = $this->createStripeCustomer($user)->id;
            $stripeCustomer->save();
        }

        return $stripeCustomer;
    }

    // Stripeの顧客を作成
    private function createStripeCustomer($user)
    {
        return \Stripe\Customer::create([
            'email' => $user->email,
        ]);
    }

    // Stripe 支払い情報を作成
    private function createPaymentIntent($amount, $stripeCustomer, $token)
    {
        try {
            $paymentMethod = \Stripe\PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'token' => $token,
                ],
            ]);

            return PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'jpy',
                'customer' => $stripeCustomer->stripe_customer_id,
                'payment_method' => $paymentMethod->id,
                'confirm' => true,
                'return_url' => 'http://localhost/payment/success',
            ]);

        } catch (\Exception $e) {
            Log::error('Payment Intent Creation Failed: ' . $e->getMessage());
            throw $e;
        }
    }
    public function success(Request $request)
    {
        return view('payment.success');
    }
}
