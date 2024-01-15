<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto mt-8">
            <div class="max-w-3xl mx-4 bg-white rounded p-8">
                <h2 class="text-3xl font-semibold mb-6">{{ __('Your Shop Dashboard') }}</h2>

                @if (session('message'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                @if(count($shops) > 0)
                    @foreach($shops as $shop)
                        <div class="mb-6">
                            <p class="text-xl font-bold text-indigo-600">{{ $shop->name }}</p>
                            <div class="mt-4">
                                <a href="{{ route('managers.edit', $shop->id) }}" class="text-blue-500 hover:underline">{{ __('Edit Shop') }}</a>
                                <a href="{{ route('managers.index') }}" class="ml-4 text-blue-500 hover:underline">{{ __('Reservation Confirmation') }}</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-700">{{ __('You have not created any shops yet.') }}</p>
                    <a href="{{ route('managers.create') }}" class="text-blue-500 hover:underline">{{ __('Create New Shop') }}</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
