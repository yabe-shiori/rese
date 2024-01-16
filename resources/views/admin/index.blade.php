<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto p-4 bg-white shadow-md rounded-md">
            <h1 class="text-3xl font-bold mb-4">管理画面</h1>

            <div class="flex space-x-4">
                <a href="{{ route('admin.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue">
                    店舗代表者作成
                </a>

                <a href="{{ route('admin.notification.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-green">
                    お知らせメール送信
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
