<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8">
        <h2 class="text-2xl font-bold text-center mb-6">予約一覧</h2>
        @foreach ($reservations->sortBy('reservation_date') as $reservation)
            <div class="bg-white shadow-md rounded-md p-6 mb-6">
                <p class="text-xl font-semibold text-gray-800 mb-4">予約ID: {{ $reservation->id }}</p>
                <p class="text-base text-gray-600 font-semibold">予約日: {{ $reservation->reservation_date }}</p>
                <p class="text-base font-semibold text-gray-600">予約時間:
                    {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</p>
                <p class="text-base font-semibold text-gray-600">ユーザー名: {{ $reservation->user->name }}</p>
                <p class="text-base font-semibold text-gray-600">人数: {{ $reservation->number_of_people }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
