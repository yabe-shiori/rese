<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-full mb-4">
                <form action="{{ route('search') }}" method="GET" class="flex items-center">
                    <select name="area" class="mr-2 p-2 rounded-md border-none focus:ring-0">
                        <option value="">All area</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                    <select name="genre" class="mr-2 p-2 rounded-md border-none focus:ring-0">
                        <option value="">All genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    <div class="relative flex items-center">
                        <input type="text" name="name" placeholder="Search..."
                            class="p-2 rounded-md pl-8 border-none focus:ring-0">
                        <button type="submit" class="bg-blue-800 text-white p-2 rounded-md ml-2">検索</button>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-5.2-5.2"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10C15 5.58172 11.4183 2 7 2C2.58172 2 0 5.58172 0 10C0 14.4183 2.58172 18 7 18C9.94939 18 12.6627 16.1172 14.1213 13.6569">
                                </path>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
            @if (isset($results) && count($results) > 0)
                @foreach ($results as $shop)
                    <div class="col-span-4 sm:col-span-2 md:col-span-1 lg:col-span-1 xl:col-span-1">
                        <div class="tile shadow-md rounded-md">
                            <img src="{{ $shop->image }}" alt="{{ $shop->name }}" class="rounded-t-lg mb-2">
                            <p class="text-xl font-bold mb-1">{{ $shop->name }}</p>
                            <div class="text-sm mb-2">
                                <span>#{{ $shop->area->name }}</span>
                                <span>#{{ $shop->genre->name }}</span>
                            </div>
                            <div class="tile-actions flex justify-between items-center">
                                <a href="{{ route('detail', ['shop_id' => $shop->id]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white mb-2">詳しくみる</a>
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
                                <p class="text-xl font-bold mb-1">{{ $shop->name }}</p>
                                <div class="text-sm mb-2">
                                    <span>#{{ $shop->area->name }}</span>
                                    <span>#{{ $shop->genre->name }}</span>
                                </div>
                                <div class="tile-actions flex justify-between items-center">
                                    <a href="{{ route('detail', ['shop_id' => $shop->id]) }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white mb-2">詳しくみる</a>
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
