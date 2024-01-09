<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'reservation_time' => ['required', 'date_format:H:i', 'between:11:00,0:00'],
            'number_of_people' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '予約日を入力してください',
            'reservation_time.required' => '予約時間を入力してください',
            'reservation_time.between' => '予約時間は11:00～0:00の間で入力してください',
            'number_of_people.required' => '人数を入力してください',
            'number_of_people.min' => '1名以上で入力してください',
            'number_of_people.max' => '10名以下で入力してください',
        ];
    }
}
