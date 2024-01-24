<x-guest-layout>
    <h2 class="bg-blue-500 p-3 text-white text-xl mb-4">Registration</h2>
    <form method="POST" action="{{ route('register') }}" class="flex flex-col items-center">
        @csrf
        <!-- Name -->
        <div class="relative flex items-center mb-4 w-full px-4">
            <img src="{{ asset('storage/icons/person.png') }}" alt="Person Icon" class="w-5 h-5 mr-2">
            <div class="relative w-full">
                <x-text-input id="name" class="block mt-1 w-full border-none focus:outline-none" type="text"
                    name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Username" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="relative flex items-center mb-4 w-full px-4">
            <img src="{{ asset('storage/icons/mail.png') }}" alt="Mail Icon" class="w-5 h-5 mr-2">
            <div class="relative w-full">
                <x-text-input id="email" class="block mt-1 w-full border-none focus:outline-none" type="email"
                    name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="relative flex items-center mb-4 w-full px-4">
            <img src="{{ asset('storage/icons/lock.png') }}" alt="Lock Icon" class="w-5 h-5 mr-2">
            <div class="relative w-full">
                <x-text-input id="password" class="block mt-1 w-full border-none focus:outline-none" type="password"
                    name="password" required autocomplete="new-password" placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="w-full text-right px-4 mb-3">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
