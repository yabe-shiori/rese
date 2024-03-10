<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <x-message :message="session('message')" />
        <x-error :message="session('error')" />

        <div class="bg-white rounded-md p-6">
            <h2 class="text-2xl font-semibold mb-6">Create Shop</h2>

             <div class="mb-8">
    <h3 class="text-lg font-semibold mb-2">Add Shops via CSV</h3>
    {{-- @if ($errors = session('errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
    <form method="POST" action="{{ route('csv.import') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="csv_file" class="block text-gray-700 text-sm font-bold mb-2">CSV File</label>
            <input id="csv_file" type="file" class="form-input w-full" name="csv_file">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Import CSV
            </button>
        </div>
    </form>
</div>

            <form method="POST" action="{{ route('managers.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Shop Name</label>
                    <input id="name" type="text" class="form-input w-full" name="name"
                        value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <textarea id="description" class="form-textarea w-full" name="description" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                    <input id="image" type="file" class="form-input w-full" name="image">
                </div>

                <div class="mb-4">
                    <label for="genre_id" class="block text-gray-700 text-sm font-bold mb-2">Genre</label>
                    <select id="genre_id" name="genre_id" class="form-select w-full" required>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="area_id" class="block text-gray-700 text-sm font-bold mb-2">Area</label>
                    <select id="area_id" name="area_id" class="form-select w-full" required>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create Shop
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
