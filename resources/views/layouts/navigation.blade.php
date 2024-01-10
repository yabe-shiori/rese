<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Hamburger and Logo -->
            <div class="flex-shrink-0 flex items-center">
                <!-- ここで `open`を切り替える -->
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <!-- ハンバーガーアイコン(色付き) -->
                   <i class="fa-solid fa-bars fa-xl" style="color: #4980df;"></i>
                    <!-- Logo -->
                    <h1 class="ml-6 text-blue-500 font-semibold text-3xl">Rese</h1>
                </button>
            </div>

            <!-- Fullscreen Menu (Show/Hide based on `open` state) -->
            <!-- `open`が真の時に表示する -->
            <div x-show="open" x-cloak @click.away="open = false" class="fixed inset-0 z-50 p-5 bg-white"
                style="display: none;">
                <div class="flex items-center justify-between h-16">
                    <!-- 閉じるボタン -->
                    <button @click="open = false"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <i class="fa-solid fa-x fa-2xl" style="color: #4c83e1;"></i>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="mt-16 space-y-1 text-center">
                    @if (Auth::check())
                        <!-- ログインしている時のメニュー項目 -->
                        <a href="{{ route('home') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Home</a>
                        <form method="POST" action="{{ route('logout') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">
                            @csrf
                            <a href="javascript:void(0);"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </a>
                        </form>
                        <a href="{{ route('profile.index') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Mypage</a>
                    @else
                        <!-- ログインしていない時のメニュー項目 -->
                        <a href="{{ route('home') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Home</a>
                        <a href="{{ route('register') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Registration</a>
                        <a href="{{ route('login') }}"
                            class="block px-3 py-6 rounded-md text-2xl font-bold text-blue-700 hover:underline">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
