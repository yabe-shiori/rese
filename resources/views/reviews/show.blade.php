<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <h1 class="text-2xl text-indigo-600 font-semibold mb-8 text-center">{{ $shop->name }}のレビュー一覧</h1>

        @forelse ($reviews as $review)
            <div class="bg-white p-6 rounded-md mb-8 shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <span class="text-2xl text-yellow-500">&#9733;</span>
                            @else
                                <span class="text-2xl text-gray-300">&#9733;</span>
                            @endif
                        @endfor
                    </div>
                    <div class="text-gray-500 text-sm">{{ $review->created_at->diffForHumans() }}</div>
                </div>
                <p class="text-lg mb-4">{{ $review->comment }}</p>
                <p class="text-sm text-gray-600">{{ $review->user->name }}</p>
            </div>
        @empty
            <p class="text-center text-gray-500">まだ口コミはありません。</p>
        @endforelse

        <div class="mt-8">
            {{ $reviews->links() }}
        </div>

        <div class="mt-8 text-center md:text-right">
            <a href="{{ route('home') }}"
                class="inline-block px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">ホームに戻る</a>
        </div>
    </div>
</x-app-layout>
