<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\ReservationReminder;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservation;
use Carbon\Carbon;

class SendReservationReminders extends Command
{
    protected $signature = 'reminder:send';
    protected $description = 'Send email reminders for reservations happening today.';

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $todayReservations = Reservation::whereDate('reservation_date', Carbon::today())->get();

        foreach ($todayReservations as $reservation)
        {
            Mail::to($reservation->user->email)->send(new ReservationReminder($reservation));

            $this->info('Sent a reminder to '.$reservation->user->name);
        }
        if ($todayReservations->isEmpty())
        {
            $this->info('No reservations for today.');
        }

    }
}
