<x-app-layout>
    <div class="max-w-md mx-auto my-8 px-4">
        <div class="bg-white shadow-md rounded-md p-4 md:p-6">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Notification Email Creation</h1>
            @if (session('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form action="{{ route('admin.notification.send') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Subject:</label>
                    <input type="text" name="subject" id="subject"
                        class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        value="{{ old('subject', $subject) }}" required>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                    <textarea name="content" id="content"
                        class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>{{ old('content', $content) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Send To:</label>
                    <div class="flex items-center space-x-4">
                        <div>
                            <input type="radio" id="allUsers" name="sendTo" value="all" checked>
                            <label for="allUsers">All Users</label>
                        </div>

                        <div>
                            <input type="radio" id="managersOnly" name="sendTo" value="managers">
                            <label for="managersOnly">Managers Only</label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center md:justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue">Send</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
