<x-app-layout>
    <div class="max-w-lg mx-auto mt-8 px-4">
        <div class="bg-white shadow-md rounded-md p-6 md:p-8">
            <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Create Manager</h2>
            <x-message :message="session('message')" />
            <form method="POST" action="{{ route('admin.store') }}">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Username</label>
                    <input id="name" type="text"
                        class="form-input w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                        name="name" value="{{ old('name') }}" required autofocus>
                </div>
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                    <input id="email" type="email"
                        class="form-input w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                        name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-10">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                    <input id="password" type="password"
                        class="form-input w-full py-3 px-4 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                        name="password" required>
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-md focus:outline-none">
                        Create Manager
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
