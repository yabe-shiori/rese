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
            this.inputChanged = true; // ここでinputChangedをtrueにセット
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
                                <li x-data="{ hovered: false }" @mouseover="hovered = true" @mouseleave="hovered = false">
                                    {{ $dish->name }} - ¥{{ $dish->price }}
                                    <div x-show="hovered" class="tooltip">
                                        {{ $dish->description }}
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
                    <h3 class="text-white mb-4 text-xl font-bold">予約</h3>
                    <form id="reservation-form" action="{{ route('reservations.store') }}" method="post">
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
                        <input type="number" x-model="numberOfPeople" name="number_of_people" min="1" required
                            class="mb-2 p-2 rounded-md w-full">
                        @error('number_of_people')
                            <div class="text-red-800 text-base">{{ $message }}</div>
                        @enderror
                        <select name="menu_id" class="mb-2 p-2 rounded-md w-full">
                            <option value="" selected>メニューを選択してください（任意）</option>
                            @foreach ($shop->dishes as $dish)
                                <option value="{{ $dish->id }}">{{ $dish->name }} - ¥{{ $dish->price }}
                                </option>
                            @endforeach
                        </select>
                        <!-- 予約フォームにクレジットカード情報の入力フィールドを追加 -->
                        <div id="card-element" x-show="selectedMenu !== ''"></div>

<script>
    const stripe = Stripe('pk_test_51OYLVZCkOf5udESXKFogt6xbIgqkok1YV7TVZ67eVMuv0ZgWdMmZmUCD4KgM0Et7dkJuXXZ4IBKeRbSmu8m9AgiQ00V2LY8yxz'); // YOUR_STRIPE_PUBLIC_KEY には実際のパブリックキーを入力してください
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('reservation-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        // メニューが選択されているか確認
        if (selectedMenu !== '') {
            // クレジットカード情報をトークン化
            const { token, error } = await stripe.createToken(cardElement);

            if (error) {
                // エラー処理
                console.error(error);
            } else {
                // トークンをフォームに追加
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = 'stripe_token';
                tokenInput.value = token.id;
                form.appendChild(tokenInput);
            }
        }

        // フォームを再送信
        form.submit();
    });
</script>
                </div>
                <div class="bg-blue-400 text-white w-4/5 h-1/4 rounded p-4 ml-6" x-show="inputChanged"
                    style="display: none;">
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
