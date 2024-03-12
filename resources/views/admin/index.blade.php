<x-app-layout>
    <div class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-message :message="session('message')" />

            <div class="container mx-auto p-8 bg-gray-800 text-white shadow-lg rounded-lg">
                <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('admin.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg flex items-center justify-center focus:outline-none focus:shadow-outline-blue">
                        <i class="fas fa-user-plus mr-2"></i> Create Manager
                    </a>
                    <a href="{{ route('admin.notification.create') }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-6 rounded-lg flex items-center justify-center focus:outline-none focus:shadow-outline-green">
                        <i class="fas fa-envelope mr-2"></i> Send Notification Email
                    </a>
                    <a href="{{ route('admin.createShop') }}"
                        class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-4 px-6 rounded-lg flex items-center justify-center focus:outline-none focus:shadow-outline-yellow">
                        <i class="fas fa-file-csv mr-2"></i> Import Shops from CSV
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
