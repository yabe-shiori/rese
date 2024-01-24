<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h2 class="bg-blue-500 p-3 text-white text-xl mb-4">login</h2>

    <form method="POST" action="{{ route('login') }}" class="flex flex-col items-center">
        @csrf

        <!-- Email Address -->
        <div class="relative flex items-center mb-4 w-full px-4">
            <img src="{{ asset('storage/icons/mail.png') }}" alt="Mail Icon" class="w-5 h-5 mr-2">
            <x-text-input id="email" class="block w-full border-none focus:outline-none" type="email"
                name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="relative flex items-center mb-4 w-full px-4">
            <img src="{{ asset('storage/icons/lock.png') }}" alt="Lock Icon" class="w-5 h-5 mr-2">
            <x-text-input id="password" class="block w-full border-none focus:outline-none" type="password"
                name="password" required autocomplete="current-password" placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="w-4/5 ml-auto text-right px-4 mb-3">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
