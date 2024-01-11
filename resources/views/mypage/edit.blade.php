<x-app-layout>
    <div x-data="{
        reservationDate: '{{ $reservation->reservation_date }}',
        reservationTime: '',
        numberOfPeople: {{ $reservation->number_of_people }},
        submitForm() {
            // 入力された時間をフォーマットしてセット
            let selectedTime = this.$refs.reservationTime.value;
            this.reservationTime = selectedTime.length > 0 ? selectedTime : '{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}';

            // 確認メッセージ
            if (confirm(`以下の内容で予約を変更しますか？\nDate: ${this.$refs.reservationDate.value}\nTime: ${this.reservationTime}\nNumber: ${this.$refs.numberOfPeople.value}`)) {
                this.$refs.reservationForm.submit();
            }
        }
    }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6 text-center">予約変更画面</h2>

        <form x-ref="reservationForm" action="{{ route('reservations.update', $reservation->id) }}" method="post">
            @csrf
            @method('put')

            <div class="mb-4">
                <label for="reservation_date" class="block text-sm font-medium text-gray-700">Date</label>
                <input x-ref="reservationDate" type="date" name="reservation_date" id="reservation_date"
                    value="{{ $reservation->reservation_date }}" required
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="reservation_date" class="block text-sm font-medium text-gray-700">Time</label>
                <select x-ref="reservationTime" name="reservation_time" required class="mb-2 p-2 rounded-md w-full">
                    @for ($hour = 11; $hour < 24; $hour++)
                        @for ($minute = 0; $minute < 60; $minute += 30)
                            @php
                                $time = sprintf('%02d:%02d', $hour % 24, $minute);
                            @endphp
                            <option value="{{ $time }}">{{ $time }}</option>
                        @endfor
                    @endfor
                    <option value="00:00">00:00</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="reservation_date" class="block text-sm font-medium text-gray-700">Number</label>
                <input x-ref="numberOfPeople" type="number" name="number_of_people" min="1" required
                    class="mb-2 p-2 rounded-md w-full">
            </div>
            <button type="button" @click="submitForm"
                class="bg-blue-900 text-white px-4 py-2 rounded-md">予約を変更</button>
        </form>
    </div>
</x-app-layout>
