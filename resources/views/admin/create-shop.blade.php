<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

        <x-message :message="session('message')" />
        <x-error :message="session('error')" />

        <div class="bg-white rounded-md p-6">
            <h2 class="text-2xl font-semibold mb-6 text-center">Create Shop</h2>
            <div class="mb-8">

                @if (count($errors) > 0)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-none list-inside">
                            @foreach ($errors as $error)
                                <li class="text-red-500 font-bold">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('csv.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 relative">
                        <label for="csv_file" class="block text-gray-700 text-sm font-bold mb-2">Choose CSV File</label>
                        <div
                            class="flex items-center justify-center w-full bg-white p-4 border border-gray-300 rounded-lg shadow-md">
                            <label for="file-upload" class="flex flex-col items-center w-full cursor-pointer">
                                <i class="fas fa-cloud-upload-alt fa-3x text-blue-500"></i>
                                <span id="file-name" class="mt-2 text-base leading-normal text-gray-600">Select a
                                    file</span>
                                <input id="file-upload" type="file" class="hidden" name="csv_file"
                                    onchange="updateFileName()">
                            </label>
                        </div>
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

    <script>
        function updateFileName() {
            var input = document.getElementById('file-upload');
            var fileName = input.files[0].name;
            var fileNameDisplay = document.getElementById('file-name');
            fileNameDisplay.innerText = fileName;
        }
    </script>
</x-app-layout>
