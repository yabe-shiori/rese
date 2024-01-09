<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-md shadow-md text-center h-1/4 w-4/12 flex flex-col items-center justify-center">
            <h1 class="text-xl mb-6 tracking-widest">会員登録ありがとうございます</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <x-primary-button class="ms-3 bg-blue-400 ">
                    {{ __('ログインする') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
