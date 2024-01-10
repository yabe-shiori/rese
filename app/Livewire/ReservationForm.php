<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;

class ReservationForm extends Component
{
    public $shop;
    public $reservation_date;
    public $reservation_time;
    public $number;

    public function mount($shop)
    {
        $this->shop = $shop;
        $this->reservation_date = date('Y-m-d');
        $this->reservation_time = '';
        $this->number = 1;  // デフォルト値を設定
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'number' => 'required|integer|min:1',
        ]);
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
    public function submit()
    {
        // Validate the data
        $this->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'number' => 'required|integer|min:1',
        ]);

        // Handle form submission (save to database, etc.)
        // For example, you can create a Reservation model and save it
        Reservation::create([
            'shop_id' => $this->shop->id,
            'reservation_date' => $this->reservation_date,
            'reservation_time' => $this->reservation_time,
            'number_of_people' => $this->number,
        ]);

        // Reset the form fields after submission
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reservation_date = date('Y-m-d');
        $this->reservation_time = '';
        $this->number = 1;
    }


}
