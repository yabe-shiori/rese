<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-md shadow-md text-center sm:h-auto sm:w-full md:w-4/12 lg:w-4/12 xl:w-4/12 flex flex-col items-center justify-center">
            <h1 class="text-xl mb-6 tracking-widest">会員登録ありがとうございます</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <x-primary-button class="mt-3 bg-blue-400">
                    {{ __('ログインする') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
