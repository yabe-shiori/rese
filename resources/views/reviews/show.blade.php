<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold mb-6">{{ $shop->name }}のレビュー一覧</h1>

        @forelse ($reviews as $review)
            <div class="bg-white p-6 rounded-md mb-6 shadow-md">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <span class="text-2xl text-yellow-500">&#9733;</span>
                            @else
                                <span class="text-2xl text-gray-300">&#9733;</span>
                            @endif
                        @endfor
                    </div>
                    <div class="ml-3">
                        <p class="text-lg font-semibold">{{ $review->user->name }}</p>
                        <p class="text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p class="text-lg mb-4">コメント: {{ $review->comment }}</p>
            </div>
        @empty
            <p>まだ口コミはありません。</p>
        @endforelse
    </div>
</x-app-layout>
