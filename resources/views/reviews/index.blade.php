<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-show="showReviews" class="mt-6 max-w-full">
            @if ($reviews->isEmpty())
                <p>口コミはまだありません。</p>
            @else
                @foreach ($reviews as $review)
                    <div class="max-w-full mb-4">
                        @if (isset($satisfactions[$review->id]) && $satisfactions[$review->id] !== '')
                            <p class="font-bold"> {{ $satisfactions[$review->id] }}</p>
                        @endif
                        <div class="mb-2 flex justify-between items-center">
                            <div class="star-rating text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <span class="text-blue-400">&#9733;</span>
                                    @else
                                        <span class="text-gray-400">&#9733;</span>
                                    @endif
                                @endfor
                            </div>

                            @if (Auth::check() && (Auth::user()->id === $review->user_id || Auth::user()->role === 'admin'))
                                <div class="flex">
                                    @if (Auth::user()->id === $review->user_id)
                                        <a href="{{ route('review.edit', $review) }}"
                                            class="text-gray-800 underline mr-4 hovet:text-blue-600">口コミを編集</a>
                                    @endif
                                    <form id="delete-form-{{ $review->id }}"
                                        action="{{ route('review.destroy', $review) }}" method="post"
                                        onsubmit="return confirm('本当に削除しますか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-gray-800 underline hover:text-blue-600">口コミを削除</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="mb-2 w-full">
                            <p class="text-base">{{ $review->comment }}</p>
                        </div>
                        <div class="overflow-x-auto">
                            <div class="flex">
                                @foreach ($review->reviewImages as $image)
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Review Image"
                                        class="w-24 h-24 mx-2 mb-2 cursor-pointer"
                                        onclick="openImage('{{ asset('storage/' . $image->image) }}')">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- 水平線 -->
                    <hr class="border-gray-300 my-4">
                @endforeach
            @endif
        </div>
    </div>

    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden"
        onclick="closeImage()">
        <div class="max-w-full" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt="Modal Image" class="max-w-full max-h-full cursor-pointer"
                onclick="event.stopPropagation()">
        </div>
    </div>

    <script>
        function openImage(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImage() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
