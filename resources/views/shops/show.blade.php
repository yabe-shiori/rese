<x-app-layout>
    <div x-data="{
        shopName: '{{ $shop->name }}',
        reservationDate: '{{ date('Y-m-d') }}',
        reservationTime: '11:00',
        numberOfPeople: 1,
        inputChanged: false
    }" x-init="() => {
        $watch('reservationDate', (value) => {
            if (value !== '{{ date('Y-m-d') }}') inputChanged = true;
        });
        $watch('reservationTime', (value) => {
            if (value !== '11:00') inputChanged = true;
        });
        $watch('numberOfPeople', (value) => {
            if (value !== 1) inputChanged = true;
        });
    }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('error'))
            <div class="border mb-4 px-4 py-3 rounded relative bg-red-100 border-red-400 text-red-700">
                {{ session('error') }}
            </div>
        @endif
        <div class="container flex flex-col sm:flex-row justify-between mt-10">
            <div class="w-full sm:w-1/2 pr-8 mb-6 sm:mb-0">
                <div class="flex mb-4">
                    <a href="{{ route('home') }}" class="text-xl font-bold px-2 bg-white shadow">&lt;</a>
                    <h2 class="text-2xl font-bold ml-2 w-full sm:w-1/2">{{ $shop->name }}</h2>
                </div>
                <div class="shop-details">
                    <img src="{{ $shop->image }}" alt="{{ $shop->name }}" class="mb-4">
                    <div class="shop-tag mb-4 font-medium">
                        <span class="mr-1 text-sm">#{{ $shop->area->name }}</span>
                        <span class="text-sm">#{{ $shop->genre->name }}</span>
                    </div>
                    <p class="font-medium tracking-widest">{{ $shop->description }}</p>
                </div>
            </div>
            <div class="w-full sm:w-5/12 bg-blue-500 rounded-lg flex flex-col justify-between">
                <div class="reservation-form p-6">
                    <h3 class="text-white mb-4 text-xl font-bold">予約</h3>
                    <form action="{{ route('reservations.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <input type="date" x-model="reservationDate" name="reservation_date"
                            value="{{ date('Y-m-d') }}" required class="mb-2 p-2 rounded-md w-full">
                        @error('reservation_date')
                            <div class="text-red-800 text-base">{{ $message }}</div>
                        @enderror
                        <select name="reservation_time" x-model="reservationTime" required
                            class="mb-2 p-2 rounded-md w-full">
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
                        <input type="number" x-model="numberOfPeople" name="number_of_people" min="1"
                            required class="mb-2 p-2 rounded-md w-full">
                        @error('number_of_people')
                            <div class="text-red-800 text-base">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="bg-blue-400 text-white w-4/5 h-1/4 rounded p-4 ml-6" x-show="inputChanged"
                        style="display: none;">
                        <p><span class="mr-8">Shop</span><span x-text="shopName"></span></p>
                        <p><span class="mr-8">Date</span><span x-text="reservationDate"></span></p>
                        <p><span class="mr-8">Time</span><span x-text="reservationTime"></span></p>
                        <p><span class="mr-8">Number</span><span x-text="numberOfPeople"></span>人</p>
                    </div>
                    <button type="submit" class="bg-blue-700 text-white w-full px-4 py-3 rounded-md">予約する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
