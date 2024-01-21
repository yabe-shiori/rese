<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-md shadow-md text-center md:w-4/12 w-full flex flex-col items-center justify-center">
            <h1 class="text-xl mb-6 tracking-widest font-bold">支払いエラー</h1>
            <p>支払い中にエラーが発生しました。</p>
            <p>{{ $error }}</p>
        </div>
    </div>
</x-app-layout>
