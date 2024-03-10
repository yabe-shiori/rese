<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-12">
            <div class="grid grid-cols-2 gap-8">
                <div class="col-span-1">
                    <div class="overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h1 class="text-3xl font-semibold text-gray-900">今回のご利用はいかがでしたか？</h1>
                        <div class="tile shadow-md rounded-md">
                            <img src="{{ asset($shop->image) }}" alt="{{ $shop->name }}" class="rounded-t-lg mb-2">
                            <p class="text-xl font-bold mb-1 ml-3">{{ $shop->name }}</p>
                            <div class="text-xs mb-2 ml-3">
                                <span class="mr-1">#{{ $shop->area->name }}</span>
                                <span>#{{ $shop->genre->name }}</span>
                            </div>
                            <div class="tile-actions flex justify-between items-center">
                                <a href="{{ route('detail', ['shop_id' => $shop->id]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white mb-2 ml-3">詳しくみる</a>
                                <form action="{{ route('favorite', ['shop_id' => $shop->id]) }}" method="post">
                                    @csrf
                                    @if (auth()->check() && auth()->user()->hasFavorited($shop))
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
                </div>
                <div class="col-span-1">
                    <div class="overflow-hidden shadow-xl sm:rounded-lg p-6 flex flex-col justify-between h-full">
                        <div>
                            <form action="{{ route('review.store', ['shop' => $shop->id]) }}" method="POST"
                                class="mb-6" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="rating"
                                        class="block text-lg font-medium text-gray-700">体験を評価してください</label>
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="radio" id="star{{ $i }}" name="rating"
                                                value="{{ $i }}" class="hidden" required />
                                            <label for="star{{ $i }}"
                                                class="text-3xl text-gray-500 cursor-pointer hover:text-blue-500"
                                                onclick="highlightStars({{ $i }})">&#9733;</label>
                                        @endfor
                                        <x-validation-errors field="rating" />
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="comment" class="block text-lg font-medium text-gray-700">口コミを投稿</label>
                                    <textarea id="comment" name="comment" rows="3" required class="mt-1 p-2 w-full border-gray-300 rounded-md">{{ old('comment') }}</textarea>
                                    <x-validation-errors field="comment" />
                                </div>
                                <div class="mb-4">
                                    <label for="images"
                                        class="block text-lg font-medium text-gray-700">画像をアップロード</label>
                                    <input type="file" id="images" name="images[]" accept="image/*" multiple
                                        class="mt-1 p-2 w-full border-gray-300 rounded-md">
                                    <x-validation-errors field="images.*" />
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">口コミを投稿</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function highlightStars(selectedIndex) {
            const stars = document.querySelectorAll('.text-gray-500.cursor-pointer');
            stars.forEach((star, index) => {
                if (index < selectedIndex) {
                    star.classList.add('text-blue-500');
                    star.classList.remove('text-gray-500');
                } else {
                    star.classList.remove('text-blue-500');
                    star.classList.add('text-gray-500');
                }
            });
            const ratingInput = document.querySelector('input[name="rating"]');
            ratingInput.value = selectedIndex;
        }
    </script>
</x-app-layout>
