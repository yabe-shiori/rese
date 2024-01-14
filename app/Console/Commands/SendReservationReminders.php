<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\ReservationReminder;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservation;
use Carbon\Carbon;

class SendReservationReminders extends Command
{
    protected $signature = 'reminder:send';//コマンド名
    protected $description = 'Send email reminders for reservations happening today.';//コマンドの説明

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        //今日の日付に該当する予約を取得
        $todayReservations = Reservation::whereDate('reservation_date', Carbon::today())->get();

        //各予約に対してリマインダーメールを送信
        foreach ($todayReservations as $reservation)
        {
            Mail::to($reservation->user->email)->send(new ReservationReminder($reservation));

            $this->info('Sent a reminder to '.$reservation->user->name);
        }
        //予約が無い場合はメッセージを表示
        if ($todayReservations->isEmpty())
        {
            $this->info('No reservations for today.');
        }

    }
}
