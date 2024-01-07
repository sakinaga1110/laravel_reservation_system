<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="bg-warning mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('reservation_system.top') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('reservation_system.top')" :active="request()->routeIs('reservation_system.top')">
                        {{ __('TOP') }}
                    </x-nav-link>
                    <x-nav-link :href="route('inquiry.index')" :active="request()->routeIs('inquiry.index')">
                        {{ __('問い合わせ確認') }}
                    </x-nav-link>
                    <x-nav-link :href="route('reservation.index')" :active="request()->routeIs('reservation.index')">
                        {{ __('予約管理') }}
                    </x-nav-link>
                    <x-nav-link :href="route('reservation_slot.index')" :active="request()->routeIs('reservation_slot.index')">
                        {{ __('予約枠管理') }}
                    </x-nav-link>
                    <x-nav-link :href="route('plan.index')" :active="request()->routeIs('plan.index')">
                        {{ __('宿泊プラン管理') }}
                    </x-nav-link>
                    <x-nav-link :href="route('charge.index')" :active="request()->routeIs('charge.index')">
                        {{ __('料金設定') }}
                    </x-nav-link>
                   
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('reservation_system.top')" :active="request()->routeIs('reservation_system.top')">
                {{ __('TOP') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('inquiry.index')" :active="request()->routeIs('inquiry.index')">
                {{ __('問い合わせ確認') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reservation.index')" :active="request()->routeIs('reservation.index')">
                {{ __('予約管理') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reservation_slot.index')" :active="request()->routeIs('reservation_slot.index')">
                {{ __('予約枠管理') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('plan.index')" :active="request()->routeIs('plan.index')">
                {{ __('宿泊プラン管理') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('charge.index')" :active="request()->routeIs('charge.index')">
                {{ __('料金設定') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">


                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
