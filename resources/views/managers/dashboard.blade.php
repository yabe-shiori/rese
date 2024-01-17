<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8">
        <div class="bg-white shadow-md rounded-md p-8">
            <h2 class="text-3xl font-semibold mb-6 text-black">Your Shop Dashboard</h2>

            @if (session('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            @if(count($shops) > 0)
                @foreach($shops as $shop)
                    <div class="bg-gray-100 rounded p-6 mb-6">
                        <p class="text-xl font-bold text-indigo-600">{{ $shop->name }}</p>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('managers.edit', $shop->id) }}" class="text-blue-500 hover:underline">Edit Shop</a>
                            <a href="{{ route('managers.index') }}" class="text-blue-500 hover:underline">Reservation Confirmation</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-gray-100 rounded p-6">
                    <p class="text-gray-700">You have not created any shops yet.</p>
                    <a href="{{ route('managers.create') }}" class="text-blue-500 hover:underline">Create New Shop</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>





