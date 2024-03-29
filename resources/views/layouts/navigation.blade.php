<nav x-data="{ open: false }" class="bg-gray-100 w-full pt-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-100">
        <div class="flex justify-between h-16">
            <!-- Hamburger and Logo -->
            <div class="flex-shrink-0 flex items-center">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <!-- ハンバーガーアイコン -->
                    <span class="fa-stack fa-lg">
                        <i class="fas fa-square fa-stack-2x" style="color: #4980df;"></i>
                        <i class="fas fa-bars fa-stack-1x fa-inverse"></i>
                    </span>
                    <!-- Logo -->
                    <h1 class="ml-6 text-blue-500 text-3xl font-black">Rese</h1>
                </button>
            </div>

            <!-- Fullscreen Menu (Show/Hide based on `open` state) -->
            <div x-show="open" x-cloak @click.away="open = false" class="fixed inset-0 z-50 p-5 bg-white"
                style="display: none;">
                <div class="flex items-center justify-between">
                    <!-- 閉じるボタン -->
                    <button @click="open = false"
                        class="inline-flex items-center justify-center p-2 rounded-md text-white bg-blue-500 w-9 h-9 hover:bg-blue-600 focus:outline-none focus:bg-blue-600 focus:text-white transition duration-150 ease-in-out">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="mt-16 space-y-1 text-center">
                    @auth
                        <!-- ログイン時のメニュー -->
                        @if (auth()->user()->role === 'admin')
                            <!-- 管理者用メニュー -->
                            <a href="{{ route('home') }}"
                                class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Home</a>
                            <a href="{{ route('admin.index') }}"
                                class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Admin
                                Dashboard</a>
                        @elseif(auth()->user()->role === 'manager')
                            <!-- 店舗代表者用メニュー -->
                            <a href="{{ route('home') }}"
                                class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Home</a>
                            <a href="{{ route('managers.dashboard') }}"
                                class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Manager
                                Dashboard</a>
                        @else
                            <!-- ユーザー用メニュー -->
                            <a href="{{ route('home') }}"
                                class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Home</a>
                            <a href="{{ route('profile.index') }}"
                                class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Mypage</a>
                        @endif

                        <!-- ログアウト -->
                        <form method="POST" action="{{ route('logout') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">
                            @csrf
                            <a href="javascript:void(0);" onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </a>
                        </form>
                    @else
                        <!-- ログインしていない時のメニュー -->
                        <a href="{{ route('home') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Home</a>
                        <a href="{{ route('register') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Registration</a>
                        <a href="{{ route('login') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
