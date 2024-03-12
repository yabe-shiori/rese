<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <x-message :message="session('message')" />
        <x-error :message="session('error')" />

        <div class="bg-white rounded-md p-6">
            <h2 class="text-2xl font-semibold mb-6 text-center">Create Shop</h2>

            <div class="mb-8">
                <h3 class="text-lg mb-2">Add Shops via CSV</h3>
                @if (!empty($errors))
                    <div class="alert alert-danger">
                        <ul style="list-style-type: none; padding-left: 0;">
                            @foreach ($errors as $error)
                                <li style="color: red; font-weight: bold;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('csv.import') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="csv_file" class="block text-gray-700 text-sm font-bold mb-2">CSV File</label>
                        <input id="csv_file" type="file" class="form-input w-full" name="csv_file">
                    </div>

                    <div class="mt-12">
                        <button type="submit"
                            class="w-full bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">
                            Import CSV
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
