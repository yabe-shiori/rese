<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6 text-center">{{ auth()->user()->name }}さん</h2>

        <div class="flex flex-col sm:flex-row gap-4">
            <!-- 左側：予約情報一覧 -->
            <div class="w-full sm:w-1/2 p-4">
                <h3 class="text-xl font-bold mb-4">予約状況</h3>
                @foreach ($reservations as $index => $reservation)
                    <div class="bg-blue-400 text-white rounded-md shadow-md p-4 mb-4">
                        <p class="text-xl mb-2">
                            <i class="fa-regular fa-clock" style="color: #4694dd;"></i>
                            予約{{ $index + 1 }}
                        </p>
                        <p><span class="mr-4">Shop</span> {{ $reservation->shop->name }}</p>
                        <p><span class="mr-4">Date</span> {{ $reservation->reservation_date }}</p>
                        <p><span class="mr-4">Time</span> {{ $reservation->reservation_time }}</p>
                        <p><span class="mr-4">Number</span> {{ $reservation->number_of_people }}人</p>
                        <!-- 他の予約情報を表示 -->
                    </div>
                @endforeach
            </div>

            <!-- 右側：お気に入り店舗一覧 -->
            <div class="w-full sm:w-1/2">
                <h3 class="text-xl font-bold mb-2">お気に入り店舗</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse ($favorites as $favorite)
                        <div class="tile shadow-md rounded-md">
                            <img src="{{ $favorite->shop->image }}" alt="{{ $favorite->shop->name }}"
                                class="rounded-t-lg mb-2 max-h-40 object-cover overflow-hidden">
                            <p class="text-xl font-bold mb-1">{{ $favorite->shop->name }}</p>
                            <div class="text-sm mb-2">
                                <span>#{{ $favorite->shop->area->name }}</span>
                                <span>#{{ $favorite->shop->genre->name }}</span>
                            </div>
                            <div class="tile-actions flex justify-between items-center">
                                <a href="{{ route('detail', ['shop_id' => $favorite->shop->id]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white mb-2">詳しくみる</a>
                                <form action="{{ route('favorite', ['shop_id' => $favorite->shop->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="heart mr-4">
                                        @if (auth()->check() &&
                                                auth()->user()->hasFavorited($favorite->shop))
                                            <i class="fa-solid fa-heart fa-xl" style="color: #f1041b;"></i>
                                        @else
                                            <i class="fa-solid fa-heart fa-xl" style="color: #d3d5d9;"></i>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>お気に入り店舗はまだありません</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
