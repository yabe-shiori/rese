<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div
            class="bg-white p-4 sm:p-8 rounded-md shadow-md text-center sm:w-full md:w-4/12 lg:w-4/12 xl:w-4/12 flex flex-col items-center justify-center">
            <h1 class="text-2xl sm:text-3xl lg:text-xl xl:text-2xl mb-4 sm:mb-6 tracking-widest font-bold">支払い成功</h1>
            <p class="text-sm sm:text-base lg:text-sm xl:text-sm mb-2 sm:mb-4">支払いが成功しました！</p>
            <p class="text-sm sm:text-base lg:text-sm xl:text-sm">支払い金額: ¥{{ number_format($payment->amount) }}</p>

            <a href="{{ route('home') }}"
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">ホームに戻る</a>
        </div>
    </div>
</x-app-layout>
