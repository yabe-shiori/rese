<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl font-extrabold mb-8 text-center text-blue-900">予約変更画面</h2>
            <form action="{{ route('reservations.update', $reservation->id) }}" method="post"
                class="bg-white shadow-md rounded-lg overflow-hidden sm:w-full md:w-96 mx-auto lg:max-w-2xl xl:max-w-3xl">
                @csrf
                @method('patch')
                <div class="px-6 py-4">
                    <div class="mb-6">
                        <label for="reservation_date" class="block text-sm font-medium text-gray-700">日付</label>
                        <input type="date" name="reservation_date" id="reservation_date"
                            value="{{ $reservation->reservation_date }}" required
                            class="mt-1 p-2 w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md">
                        @error('reservation_date')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="reservation_time" class="block text-sm font-medium text-gray-700">時間</label>
                        <select name="reservation_time" id="reservation_time" required
                            class="mb-2 p-2 rounded-md w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @for ($hour = 11; $hour < 24; $hour++)
                                @for ($minute = 0; $minute < 60; $minute += 30)
                                    @php
                                        $time = sprintf('%02d:%02d', $hour % 24, $minute);
                                    @endphp
                                    <option value="{{ $time }}">{{ $time }}</option>
                                @endfor
                            @endfor
                            <option value="00:00">00:00</option>
                        </select>
                        @error('reservation_time')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="number_of_people" class="block text-sm font-medium text-gray-700">人数</label>
                        <input type="number" name="number_of_people" id="number_of_people" min="1"
                            value="{{ $reservation->number_of_people }}" required
                            class="mb-2 p-2 rounded-md w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        @error('number_of_people')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 text-center sm:text-right">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                        予約を変更
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
