<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Shop;
use App\Mail\ReservationConfirmed;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;


class ReservationControllerTest extends TestCase
{


    public function testStoreReservation()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);


        $shop = Shop::first();

        $this->actingAs($user);
        Mail::fake();
        $this->withSession([]);
        $response = $this->post('/reservations', [
            'shop_id' => $shop->id,
            'reservation_date' => '2024-01-30',
            'reservation_time' => '12:00',
            'number_of_people' => 2,
        ]);

        $response->dump();
        $response->assertRedirect('/shops/done');



        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'shop_id' => $shop->id,
            'reservation_date' => '2024-01-30',
            'reservation_time' => '12:00:00',
            'number_of_people' => 2,
        ]);

        Mail::assertSent(ReservationConfirmed::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
