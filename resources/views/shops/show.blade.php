<x-app-layout>
    <div x-data="{
        shopName: '{{ $shop->name }}',
        reservationDate: '{{ date('Y-m-d') }}',
        reservationTime: '11:00',
        numberOfPeople: 1,
        inputChanged: false,
        selectedMenu: '',
        selectedMenuName: '',
        getSelectedMenuName() {
            this.selectedMenuName = this.selectedMenu ? this.$refs.menuList.options[this.$refs.menuList.selectedIndex].text : '';
            this.inputChanged = true;
        }
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
                    <img src="{{ asset($shop->image) }}" alt="{{ $shop->name }}" class="rounded-t-lg mb-2">
                    <div class="shop-tag mb-4 font-medium">
                        <span class="mr-1 text-sm">#{{ $shop->area->name }}</span>
                        <span class="text-sm">#{{ $shop->genre->name }}</span>
                    </div>
                    <p class="font-medium tracking-widest">{{ $shop->description }}</p>
                    <h4 class="text-lg font-bold mt-4">メニュー</h4>
                    @if ($shop->dishes)
                        <ul class="menu-list">
                            @foreach ($shop->dishes as $dish)
                                <li x-data="{ showModal: false }">
                                    <div @click="showModal = true" class="cursor-pointer hover:text-blue-600">
                                        {{ $dish->name }} - ¥{{ number_format($dish->price, 0, '.', ',') }}
                                    </div>
                                    <div x-show="showModal"
                                        class="fixed inset-0 bg-black bg-opacity-50 h-full w-full flex justify-center items-start pt-10"
                                        @click.away="showModal = false">
                                        <div class="modal bg-white p-4 max-w-sm mx-auto rounded shadow-lg">
                                            <div class="font-bold text-lg">{{ $dish->name }}</div>
                                            <p class="text-gray-700 mt-2">{{ $dish->description }}</p>
                                            <div class="mt-4 flex justify-end">
                                                <button @click="showModal = false"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    閉じる
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>メニューはまだ登録されていません。</p>
                    @endif
                </div>
            </div>
            <div class="w-full sm:w-5/12 bg-blue-500 rounded-lg flex flex-col justify-between">
                <div class="reservation-form p-6">
                    <h3 class="text-white mb-4 py-6 text-xl font-bold">予約</h3>
                    <form id="reservation-form" action="{{ route('reservations.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <input type="date" x-model="reservationDate" name="reservation_date"
                            value="{{ date('Y-m-d') }}" required class="mb-3 p-2 rounded-md w-full">
                        @error('reservation_date')
                            <div class="text-red-800 text-base">{{ $message }}</div>
                        @enderror
                        <select name="reservation_time" x-model="reservationTime" required
                            class="mb-3 p-2 rounded-md w-full">
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
                        <input type="number" x-model="numberOfPeople" name="number_of_people" min="1" required
                            class="mb-3 p-2 rounded-md w-full">
                        @error('number_of_people')
                            <div class="text-red-800 text-base">{{ $message }}</div>
                        @enderror
                </div>
                <div x-show="inputChanged" class="bg-blue-400 bg-opacity-80 text-white w-4/5 h-1/4 rounded p-4 ml-6">
                    <p><span class="mr-8">Shop</span><span x-text="shopName"></span></p>
                    <p><span class="mr-8">Date</span><span x-text="reservationDate"></span></p>
                    <p><span class="mr-8">Time</span><span x-text="reservationTime"></span></p>
                    <p><span class="mr-8">Number</span><span x-text="numberOfPeople"></span>人</p>
                    <p x-show="selectedMenuName"><span class="mr-8">Menu</span><span x-text="selectedMenuName"></span>
                    </p>
                </div>
                <button type="submit" class="bg-blue-700 text-white w-full px-4 py-3 rounded-md">予約する</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
