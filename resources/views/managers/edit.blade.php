<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8">
        <div class="bg-white p-8 shadow-md rounded-md">
            <h2 class="text-3xl font-semibold mb-6 text-blue-500">Edit Shop</h2>

            @if (session('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('managers.update', $shop->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Shop Name</label>
                    <input id="name" type="text" class="form-input w-full" name="name" value="{{ old('name', $shop->name) }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-semibold mb-2">Description</label>
                    <textarea id="description" class="form-textarea w-full h-32" name="description" required>{{ old('description', $shop->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 text-sm font-semibold mb-2">Image</label>
                    <input id="image" type="file" class="form-input w-full" name="image">
                </div>

                <div class="mb-4">
                    <label for="genre_id" class="block text-gray-700 text-sm font-semibold mb-2">Genre</label>
                    <select id="genre_id" name="genre_id" class="form-select w-full" required>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="area_id" class="block text-gray-700 text-sm font-semibold mb-2">Area</label>
                    <select id="area_id" name="area_id" class="form-select w-full" required>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" {{ $shop->area_id == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Shop
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
