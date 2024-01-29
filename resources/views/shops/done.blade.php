<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-md shadow-md text-center md:w-6/12 w-full md:mx-4">
            <h1 class="text-xl mb-6 tracking-widest">ご予約ありがとうございます</h1>

            <!-- 事前に決済する場合のフォーム -->
            <form action="{{ route('payment.index') }}" method="get">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                <button type="submit" class="text-blue-500 mt-4 inline-block">支払いへ進む</button>
            </form>

            <a href="{{ route('home') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4 inline-block">戻る</a>
        </div>
    </div>
</x-app-layout>
