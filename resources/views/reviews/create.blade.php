<x-app-layout>
    <div class="py-12">
        <x-error :message="session('error')" />

        <form action="{{ route('review.store', ['shop' => $shop->id]) }}" method="POST" class="mb-6"
            enctype="multipart/form-data" id="reviewForm">
            @csrf
            <div class="relative flex justify-center">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full lg:w-w-4/5">
                    <div class="col-span-1 mx-auto w-1/2">
                        <h2 class="text-3xl font-semibold text-gray-900 my-10">今回のご利用はいかがでしたか？</h2>
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
                                <div class="tile-actions flex justify-between items-center">
                                    @if (auth()->check() && auth()->user()->hasFavorited($shop))
                                        <span class="heart mr-4">
                                            <i class="fa-solid fa-heart fa-xl" style="color: #f1041b;"></i>
                                        </span>
                                    @else
                                        <span class="heart mr-4">
                                            <i class="fa-solid fa-heart fa-xl" style="color: #d3d5d9;"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 mx-auto w-4/5 text-center md:text-left">
                        <div class="mb-4">
                            <label for="rating"
                                class="block text-xl font-medium text-gray-700 mb-2">体験を評価してください</label>
                            <div class="flex items-center justify-center md:justify-start">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{ $i }}" name="rating"
                                        value="{{ $i }}" class="hidden" required />
                                    <label for="star{{ $i }}"
                                        class="text-3xl text-gray-500 cursor-pointer mr-1 hover:text-blue-500"
                                        onclick="highlightStars({{ $i }})">&#9733;</label>
                                @endfor
                            </div>
                            <div id="ratingError" class="text-red-500"></div>
                        </div>
                        <div class="my-8">
                            <label for="comment" class="block text-xl font-medium text-gray-700">口コミを投稿</label>
                            <textarea id="comment" name="comment" rows="3" required class="mt-1 p-2 w-full border-gray-300 rounded-md">{{ old('comment') }}</textarea>
                            <div id="characterCount" class="text-xs text-gray-500 text-right">0/400 (最高文字数)</div>
                            <x-validation-errors field="comment" />
                        </div>
                        <div class="mb-8 text-center">
                            <label for="images"
                                class="block text-xl font-medium text-gray-700 text-center md:text-left">画像の追加</label>
                            <div class="mt-2 p-6 w-full bg-white rounded-md border-dashed cursor-pointer relative">
                                <span class="block font-bold mb-2">クリックして画像を追加</span>
                                <span class="block text-sm mb-2">またはドラッグアンドドロップ</span>
                                <span id="imageCount" class="text-xs text-gray-500"></span>
                                <input type="file" id="images" name="images[]" accept="image/*" multiple
                                    class="opacity-0 absolute inset-0">
                            </div>
                            <x-validation-errors field="images.*" />
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 left-1/2 bg-gray-300 w-px transform -translate-x-1/2 hidden md:block">
                </div>
            </div>
            <div class="text-center mt-10">
                <button type="button" onclick="submitForm()"
                    class="bg-white font-bold py-2 text-base  px-4 rounded w-full rounded-full md:w-1/2">口コミを投稿</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.text-gray-500.cursor-pointer');
            let ratingValue = 0;
            const ratingInputs = document.querySelectorAll('input[name="rating"]');

            stars.forEach((star, index) => {
                if (index < ratingValue) {
                    star.classList.add('text-blue-500');
                    star.classList.remove('text-gray-500');
                }

                star.addEventListener('click', function() {
                    ratingValue = index + 1;

                    stars.forEach((s, i) => {
                        if (i < ratingValue) {
                            s.classList.add('text-blue-500');
                            s.classList.remove('text-gray-500');
                        } else {
                            s.classList.remove('text-blue-500');
                            s.classList.add('text-gray-500');
                        }
                    });

                    ratingInputs.forEach(input => {
                        if (input.value == ratingValue) {
                            input.checked = true;
                        } else {
                            input.checked = false;
                        }
                    });
                });
            });

            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                const ratingInput = document.querySelector('input[name="rating"]');
                ratingInput.value = ratingValue;
            });
        });

        const inputElement = document.getElementById("images");
        const imageCount = document.getElementById("imageCount");

        inputElement.addEventListener("change", handleFileSelect);

        function handleFileSelect(event) {
            const fileList = event.target.files;
            if (fileList.length > 0) {
                let fileNames = "";
                for (let i = 0; i < fileList.length; i++) {
                    fileNames += `${fileList[i].name}`;
                    if (i < fileList.length - 1) {
                        fileNames += ", ";
                    }
                }
                imageCount.textContent = `選択された画像: ${fileNames}`;
            } else {
                imageCount.textContent = "";
            }
        }

        const commentInput = document.getElementById("comment");
        const characterCount = document.getElementById("characterCount");

        commentInput.addEventListener("input", updateCharacterCount);

        function updateCharacterCount() {
            const currentLength = commentInput.value.length;
            characterCount.textContent = `${currentLength}/400`;
        }

        function submitForm() {
            const ratingInput = document.querySelector('input[name="rating"]:checked');
            const ratingError = document.getElementById('ratingError');
            if (!ratingInput) {
                ratingError.textContent = '評価を選択してください。';
            } else {
                ratingError.textContent = '';
                const reviewForm = document.getElementById('reviewForm');
                reviewForm.submit();
            }
        }
    </script>
</x-app-layout>
