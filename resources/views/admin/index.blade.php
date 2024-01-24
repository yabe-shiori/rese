<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto p-4 bg-gray-800 text-white shadow-md rounded-md">
            @if (session('message'))
                <div class="bg-green-500 text-green-100 p-4 mb-4">
                    {{ session('message') }}
                </div>
            @endif
            <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                <a href="{{ route('admin.create') }}"
                    class="w-full md:w-auto max-w-xs bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md focus:outline-none focus:shadow-outline-blue">
                    Create Manager
                </a>
                <a href="{{ route('admin.notification.create') }}"
                    class="w-full md:w-auto max-w-xs bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-md focus:outline-none focus:shadow-outline-green">
                    Send Notification Email
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
