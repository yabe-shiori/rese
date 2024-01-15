<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto mt-8">
            <div class="max-w-md mx-auto bg-white rounded p-8">
                <h2 class="text-2xl font-semibold mb-6">{{ __('Create Manager') }}</h2>

                @if (session('message'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name"
                            class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                        <input id="name" type="text" class="form-input w-full" name="name"
                            value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="email"
                            class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input id="email" type="email" class="form-input w-full" name="email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="password"
                            class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input id="password" type="password" class="form-input w-full" name="password" required>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Create Manager') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
