<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 p-4">
        <x-message :message="session('message')" />
        <div class="bg-white shadow-md rounded-md p-6">
            @if(count($shops) > 0)
                @foreach($shops as $shop)
                    <h2 class="text-2xl md:text-3xl font-bold mb-4 text-indigo-600">{{ $shop->name }} Dashboard</h2>
                    <div class="bg-gray-100 hover:shadow-md transition duration-300 rounded p-4 mb-4">
                        <div class="mt-2 flex flex-col md:flex-row items-center md:justify-between">
                            <a href="{{ route('managers.edit', $shop->id) }}" class="text-blue-600 hover:underline mb-2 md:mb-0">
                                <i class="fas fa-edit mr-2"></i>Edit Shop
                            </a>
                            <a href="{{ route('managers.index') }}" class="text-blue-600 hover:underline">
                                <i class="fas fa-calendar-check mr-2"></i>Reservation Confirmation
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <h2 class="text-2xl md:text-3xl font-bold mb-4 text-indigo-600">Your Shop Dashboard</h2>
                <div class="bg-gray-100 hover:shadow-md transition duration-300 rounded p-4">
                    <p class="text-gray-700 mb-2">You have not created any shops yet.</p>
                    <a href="{{ route('managers.create') }}" class="text-blue-600 hover:underline">
                        <i class="fas fa-plus mr-2" style="color: #1e67e6;"></i>Create New Shop
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
