<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto p-4 bg-white shadow-md rounded-md">
            <h1 class="text-3xl font-bold mb-4">お知らせメール作成</h1>

            <form action="{{ route('admin.notification.send') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">件名:</label>
                    <input type="text" name="subject" id="subject"
                        class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        value="{{ old('subject', $subject) }}" required>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">内容:</label>
                    <textarea name="content" id="content"
                        class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>{{ old('content', $content) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">送信対象:</label>
                    <div>
                        <input type="radio" id="allUsers" name="sendTo" value="all" checked>
                        <label for="allUsers">全ユーザー</label>

                        <input type="radio" id="managersOnly" name="sendTo" value="managers">
                        <label for="managersOnly">店舗代表者</label>
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue">送信</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
