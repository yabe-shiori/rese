<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- セッションメッセージ表示エリア -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- 予約した店舗一覧 -->
        <div class="grid grid-cols-4 gap-4 pt-6">
            @forelse ($pastReservations as $reservation)
                <div class="col-span-4 sm:col-span-2 md:col-span-1 lg:col-span-1 xl:col-span-1" x-data="{ open: false }">
                    <div class="tile shadow-md rounded-md">
                        <img src="{{ $reservation->shop->image }}" alt="{{ $reservation->shop->name }}" class="rounded-t-lg mb-2">
                        <p class="text-xl font-bold mb-1 ml-3">{{ $reservation->shop->name }}</p>
                        <div class="text-xs mb-2 ml-3">
                            <span class="mr-1">#{{ $reservation->shop->area->name }}</span>
                            <span>#{{ $reservation->shop->genre->name }}</span>
                        </div>
                        <div class="tile-actions flex justify-between items-center">
                            <button @click="open = ! open"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white mb-2 ml-3">レビューを書く</button>
                        </div>
                    </div>

                    <!-- レビューフォーム -->
                    <div x-show="open" x-cloak x-transition class="mt-4 p-4 bg-white shadow-md rounded-md">
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">

                            <!-- 評価選択部分 -->
                            <div class="mb-4">
                                <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">評価</label>
                                <select id="rating" name="rating" class="form-select rounded-md shadow-sm border-gray-300">
                                    <option value="">選択してください</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- コメント入力部分 -->
                            <div class="mb-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">コメント</label>
                                <textarea id="comment" name="comment" rows="3" class="form-textarea mt-1 block w-full rounded-md shadow-sm border-gray-300"></textarea>
                            </div>

                            <!-- 送信ボタン -->
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-blue-700">レビューを投稿</button>
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
