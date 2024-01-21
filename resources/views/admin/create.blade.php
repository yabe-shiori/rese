<x-app-layout>
    <div class="max-w-md mx-auto mt-8">
        <div class="bg-white shadow-md rounded-md p-8">
            <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Create Manager</h2>

            @if (session('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Username</label>
                    <input id="name" type="text" class="form-input w-full py-2 px-3 border border-gray-300 rounded"
                        name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                    <input id="email" type="email" class="form-input w-full py-2 px-3 border border-gray-300 rounded"
                        name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                    <input id="password" type="password"
                        class="form-input w-full py-2 px-3 border border-gray-300 rounded" name="password" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md">
                        Create Manager
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
