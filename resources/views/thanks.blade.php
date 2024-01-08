<x-guest-layout>
    <!-- Session Status -->
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
    <h2 class="text-center text-xl mb-10">会員登録ありがとうございます</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf
            <x-primary-button class="ms-3 bg-blue-400 ">
                {{ __('ログインする') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
