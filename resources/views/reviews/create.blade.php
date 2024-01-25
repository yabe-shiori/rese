<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- セッションメッセージ表示エリア -->
        <x-message :message="session('message')" />
        @if (session('error'))
            <div class="border mb-4 px-4 py-3 rounded relative bg-red-100 border-red-400 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <!-- 予約した店舗一覧 -->
        <div class="grid grid-cols-4 gap-4 pt-6">
            @forelse ($filteredPastReservations as $reservation)
                <div class="col-span-4 sm:col-span-2 md:col-span-1 lg:col-span-1 xl:col-span-1" x-data="{ open: false }">
                    <div class="tile shadow-md rounded-md">
                        <img src="{{ $reservation->shop->image }}" alt="{{ $reservation->shop->name }}"
                            class="rounded-t-lg mb-2">
                        <p class="text-xl font-bold mb-1 ml-3">{{ $reservation->shop->name }}</p>
                        <div class="text-xs mb-2 ml-3">
                            <span class="mr-1">#{{ $reservation->shop->area->name }}</span>
                            <span>#{{ $reservation->shop->genre->name }}</span>
                        </div>
                        <div class="tile-actions flex justify-between items-center">
                            <div class="flex-grow"></div>
                            <button @click="open = ! open"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white mb-2 mr-3">レビューを書く</button>
                        </div>
                    </div>
                    <!-- レビューフォーム -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="mt-4 p-6 bg-white shadow-lg rounded transition-all transform" x-cloak>
                        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                            <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                            <!-- 評価選択部分 -->
                            <div>
                                <label for="rating" class="block text-gray-800 font-semibold mb-1">評価</label>
                                <select id="rating" name="rating"
                                    class="w-full form-select block rounded-md border-gray-300 shadow p-3 bg-gray-50">
                                    <option value="">選択してください</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <!-- コメント入力部分 -->
                            <div>
                                <label for="comment" class="block text-gray-800 font-semibold mb-1">コメント</label>
                                <textarea id="comment" name="comment" rows="4"
                                    class="w-full form-textarea block rounded-md border-gray-300 shadow p-3 bg-gray-50"></textarea>
                            </div>
                            <!-- 送信ボタン -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 rounded-lg font-semibold text-white shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50"
                                    aria-label="レビューを投稿する">レビューを投稿</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-4">
                    <p class="text-center text-gray-500">過去に予約した店舗はありません。</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
