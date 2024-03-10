<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('error'))
            <div class="border mb-4 px-4 py-3 rounded relative bg-red-100 border-red-400 text-red-700">
                {{ session('error') }}
            </div>
        @endif
       <div class="flex mb-4">
            <!-- 並び替え -->
            <div class="mr-4">
                <label for="sort_by" class="text-gray-700">並び替え：</label>
                <select name="sort_by" id="sort_by" class="p-2 rounded-md border-none focus:ring-0">
                    <option value="random" {{ request('sort_by') == 'random' ? 'selected' : '' }}>ランダム</option>
                    <option value="high_rating" {{ request('sort_by') == 'high_rating' ? 'selected' : '' }}>評価が高い順</option>
                    <option value="low_rating" {{ request('sort_by') == 'low_rating' ? 'selected' : '' }}>評価が低い順</option>
                </select>
            </div>

            <!-- 検索欄 -->
            <div class="mb-4 sm:w-full md:w-1/2 lg:w-1/2 bg-white rounded shadow-md p-2 ml-auto">
                <form action="{{ route('search') }}" method="GET" class="flex items-center">
                    <!-- エリア検索 -->
                    <select name="area" class="mr-4 p-2 pr-8 rounded-md border-none focus:ring-0">
                        <option value="" disabled {{ !request('area') ? 'selected' : '' }}>All area</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>
                                {{ $area->name }}</option>
                        @endforeach
                    </select>
                    <!-- ジャンル検索 -->
                    <select name="genre" class="mr-4 p-2 pr-8 rounded-md border-none focus:ring-0">
                        <option value="" disabled {{ !request('genre') ? 'selected' : '' }}>All genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}</option>
                        @endforeach
                    </select>
                    <!-- 店名検索 -->
                    <div class="relative flex items-center w-full">
                        <input type="text" name="name" placeholder="Search..."
                            class="p-2 rounded-md pl-8 border-none focus:ring-0 w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <i class="fa-solid fa-search text-gray-500"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
            @if (isset($results) && count($results) > 0)
                @foreach ($results as $shop)
                    <div>
                        <div class="tile shadow-md rounded-md">
                            <img src="{{ asset($shop->image) }}" alt="{{ $shop->name }}" class="rounded-t-lg mb-2">
                            <p class="text-xl font-bold mb-1 ml-3">{{ $shop->name }}</p>
                            <div class="text-sm mb-2 ml-3">
                                <span class="mr-1">#{{ $shop->area->name }}</span>
                                <span>#{{ $shop->genre->name }}</span>
                            </div>
                            <div class="text-sm mb-2 ml-3 flex items-center space-x-1">
                                    @php
                                        $averageRating = $shop->averageRating();
                                    @endphp

                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $averageRating)
                                            <i class="fas fa-star text-yellow-500"></i>
                                        @elseif ($i - 0.5 <= $averageRating)
                                            <div class="relative inline-block">
                                                <i class="fas fa-star text-gray-300"></i>
                                                <div class="absolute top-0 left-0 overflow-hidden" style="width: 50%;">
                                                    <i class="fas fa-star text-yellow-500"></i>
                                                </div>
                                            </div>
                                        @else
                                            <i class="fas fa-star text-gray-300"></i>
                                        @endif
                                    @endfor
                            </div>

                            <div class="tile-actions flex justify-between items-center">
                                <a href="{{ route('detail', ['shop_id' => $shop->id]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white mb-2 ml-3">詳しくみる</a>
                                <form action="{{ route('favorite', ['shop_id' => $shop->id]) }}" method="post">
                                    @csrf
                                    @if (auth()->check() &&
                                            auth()->user()->hasFavorited($shop))
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
                    </div>
                @endforeach
            @else
                @foreach ($shops as $shop)
                    <div>
                        <div class="tile shadow-md rounded-md">
                            <img src="{{ asset($shop->image) }}" alt="{{ $shop->name }}" class="rounded-t-lg mb-2">
                            <p class="text-xl font-bold mb-1 ml-3">{{ $shop->name }}</p>
                            <div class="text-xs mb-2 ml-3">
                                <span class="mr-1">#{{ $shop->area->name }}</span>
                                <span>#{{ $shop->genre->name }}</span>
                            </div>
                            <div class="text-sm mb-2 ml-3 flex items-center space-x-1">
                                @php
                                    $averageRating = $shop->averageRating();
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $averageRating)
                                        <i class="fas fa-star text-yellow-500"></i>
                                    @elseif ($i - 0.5 <= $averageRating)
                                        <div class="relative inline-block">
                                            <i class="fas fa-star text-gray-300"></i>
                                            <div class="absolute top-0 left-0 overflow-hidden" style="width: 50%;">
                                                <i class="fas fa-star text-yellow-500"></i>
                                            </div>
                                        </div>
                                    @else
                                        <i class="fas fa-star text-gray-300"></i>
                                    @endif
                                @endfor
                            </div>

                            <div class="tile-actions flex justify-between items-center">
                                <a href="{{ route('detail', ['shop_id' => $shop->id]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white mb-2 ml-3">詳しくみる</a>
                                <form action="{{ route('favorite', ['shop_id' => $shop->id]) }}" method="post">
                                    @csrf
                                    @if (auth()->check() &&
                                            auth()->user()->hasFavorited($shop))
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
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <script>
        // 並び替え用のセレクトボックスを取得
        const sortSelect = document.getElementById('sort_by');

        // セレクトボックスの値が変更されたときに実行される関数
        sortSelect.addEventListener('change', function() {
            // 選択された並び替えの値を取得
            const selectedSort = sortSelect.value;

            // 現在のURLを取得
            const currentUrl = new URL(window.location.href);

            // 並び替えのクエリパラメータを設定
            currentUrl.searchParams.set('sort_by', selectedSort);

            // ページをリロード
            window.location.href = currentUrl.toString();
        });
    </script>
</x-app-layout>
