<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6 text-center">{{ auth()->user()->name }}さん</h2>
        <x-message :message="session('message')" />
        <div class="text-center py-4">
            <a href="{{ route('reviews.create') }}"
                class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full transition-colors duration-300">
                口コミを投稿する
            </a>
        </div>
        <div class="flex flex-col justify-between sm:flex-row gap-4">
            <div class="w-full sm:w-2/5 p-4">
                <h3 class="text-xl font-bold mb-4">予約状況</h3>
                @foreach ($reservations as $index => $reservation)
                    <div class="relative">
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                            class="absolute top-0 right-0 mt-2 mr-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('予約を削除してもよろしいですか？');"
                                class="flex items-center justify-center w-6 h-6 bg-transparent border-2 border-white rounded-full text-white hover:bg-blue-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="text-decoration-none">
                            <div class="bg-blue-500 text-white rounded-md shadow-md p-4 mb-4 cursor-pointer">
                                <p class="text-base mb-4">
                                    <i class="fa-regular fa-clock" style="color: #f4f5f7;"></i>
                                    予約{{ $index + 1 }}
                                </p>
                                <p><span class="mr-4">Shop</span> {{ $reservation->shop->name }}</p>
                                <p><span class="mr-4">Date</span> {{ $reservation->reservation_date }}</p>
                                <p><span class="mr-4">Time</span>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}
                                </p>
                                <p><span class="mr-4">Number</span> {{ $reservation->number_of_people }}人</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="w-full sm:w-1/2 p-4">
                <h3 class="text-xl font-bold mb-2">お気に入り店舗</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse ($favorites as $favorite)
                        <div class="tile shadow-md rounded-md">
                            <img src="{{ $favorite->shop->image }}" alt="{{ $favorite->shop->name }}"
                                class="rounded-t-lg mb-2 w-full h-40 object-cover overflow-hidden">
                            <p class="text-base font-bold mb-1 ml-2">{{ $favorite->shop->name }}</p>
                            <div class="text-sm mb-2 ml-2">
                                <span>#{{ $favorite->shop->area->name }}</span>
                                <span>#{{ $favorite->shop->genre->name }}</span>
                            </div>
                            <div class="tile-actions flex justify-between items-center">
                                <a href="{{ route('detail', ['shop_id' => $favorite->shop->id]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white mb-2 ml-2">詳しくみる</a>
                                <form action="{{ route('favorite', ['shop_id' => $favorite->shop->id]) }}"
                                    method="post" onsubmit="return confirm('この店舗をお気に入りから削除しますか？');">
                                    @csrf
                                    @if (auth()->check() &&
                                            auth()->user()->hasFavorited($favorite->shop))
                                        <!-- お気に入り削除 -->
                                        @method('delete')
                                        <button type="submit" class="heart mr-4">
                                            <i class="fa-solid fa-heart fa-xl" style="color: #f1041b;"></i>
                                        </button>
                                    @else
                                        <!-- お気に入り登録 -->
                                        <button type="submit" class="heart mr-4">
                                            <i class="fa-solid fa-heart fa-xl" style="color: #d3d5d9;"></i>
                                        </button>
                                    @endif
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
