<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container flex justify-between">
            <div class="w-1/2 pr-8">
                <div class="shop-details">
                    <h2 class="text-2xl font-bold mb-2">{{ $shop->name }}</h2>
                    <img src="{{ $shop->image }}" alt="{{ $shop->name }}" class="mb-4 rounded-lg">
                    <div class="shop-tag mb-4">
                        <span># {{ $shop->area->name }}</span>
                        <span># {{ $shop->genre->name }}</span>
                    </div>
                    <p>{{ $shop->description }}</p>
                </div>
            </div>
            <div class="w-5/12 bg-blue-700 rounded-lg flex flex-col justify-between">
                <div class="reservation-form p-6">
                    <h3 class="text-white mb-4 text-xl font-bold">予約</h3>
                    <form action="{{ route('reservations.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <input type="date" name="reservation_date" value="{{ date('Y-m-d') }}" required
                            class="mb-2 p-2 rounded-md w-1/2">
                        <select name="reservation_time" required class="mb-2 p-2 rounded-md w-full">
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
                        <input type="number" name="number_of_people" min="1" required class="mb-2 p-2 rounded-md w-full">
                </div>
                <div class="bg-blue-300 text-white w-4/5 h-1/4 mx-auto rounded">
                    <p>Shop</p>
                    <p>Date</p>
                    <p>Time</p>
                    <p>Number</p>
                </div>
                <button type="submit" class="bg-blue-900 text-white w-full px-4 py-3 rounded-md">予約する</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
