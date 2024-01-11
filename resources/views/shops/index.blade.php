<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-4 w-1/2 bg-white rounded shadow-md p-2 ml-auto">
        <form action="{{ route('search') }}" method="GET" class="flex items-center">
            <select name="area" class="mr-4 p-2 pr-8 rounded-md border-none focus:ring-0">
                <option value="" disabled {{ !request('area') ? 'selected' : '' }}>All area</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                @endforeach
            </select>
            <select name="genre" class="mr-4 p-2 pr-8 rounded-md border-none focus:ring-0">
                <option value="" disabled {{ !request('genre') ? 'selected' : '' }}>All genre</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
            <div class="relative flex items-center">
                <input type="text" name="name" placeholder="Search..."
                    class="p-2 rounded-md pl-8 border-none focus:ring-0">
                <button type="submit" class="bg-blue-800 text-white p-2 rounded-md ml-2">検索</button>
                <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <i class="fa-solid fa-search text-gray-500"></i>
                </div>
            </div>
        </form>
    </div>
        <div class="grid grid-cols-4 gap-4">
            @if (isset($results) && count($results) > 0)
                @foreach ($results as $shop)
                    <div class="col-span-4 sm:col-span-2 md:col-span-1 lg:col-span-1 xl:col-span-1">
                        <div class="tile shadow-md rounded-md">
                            <img src="{{ $shop->image }}" alt="{{ $shop->name }}" class="rounded-t-lg mb-2">
                            <p class="text-xl font-bold mb-1 ml-3">{{ $shop->name }}</p>
                            <div class="text-sm mb-2 ml-3">
                                <span class="mr-1">#{{ $shop->area->name }}</span>
                                <span>#{{ $shop->genre->name }}</span>
                            </div>
                            <div class="tile-actions flex justify-between items-center">
                                <a href="{{ route('detail', ['shop_id' => $shop->id]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white mb-2 ml-3">詳しくみる</a>
                                <form action="{{ route('favorite', ['shop_id' => $shop->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="heart mr-4">
                                        @if (auth()->check() &&
                                                auth()->user()->hasFavorited($shop))
                                            <i class="fa-solid fa-heart fa-xl" style="color: #f1041b;"></i>
                                        @else
                                            <i class="fa-solid fa-heart fa-xl" style="color: #d3d5d9;"></i>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @isset($shops)
                    @foreach ($shops as $shop)
                        <div class="col-span-4 sm:col-span-2 md:col-span-1 lg:col-span-1 xl:col-span-1">
                            <div class="tile shadow-md rounded-md">
                                <img src="{{ $shop->image }}" alt="{{ $shop->name }}" class="rounded-t-lg mb-2">
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
                                        <button type="submit" class="heart mr-4">
                                            @if (auth()->check() &&
                                                    auth()->user()->hasFavorited($shop))
                                                <i class="fa-solid fa-heart fa-xl" style="color: #f1041b;"></i>
                                            @else
                                                <i class="fa-solid fa-heart fa-xl" style="color: #d3d5d9;"></i>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            @endif
        </div>
    </div>

</x-app-layout>
