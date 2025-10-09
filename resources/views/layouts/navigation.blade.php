<nav 
    x-data="{ open: false }" 
    class="sticky top-0 z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-lg border-b border-gray-200 dark:border-gray-700 shadow-sm transition-all duration-300"
>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/hydro.jpg') }}" alt="Logo" class="h-9 w-auto">
                        <span class="text-lg font-semibold text-gray-800 dark:text-gray-100">MyApp</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center space-x-1">
                    @php
                        $links = [
                            ['Dashboard', 'dashboard'],
                            ['Permissions', 'permissions.index'],
                            ['Roles', 'roles.index'],
                            ['Employees', 'employees.index'],
                            ['Salaries', 'salaries.index'],
                            ['Attendance', 'attendances.index'],
                            ['Site', 'sites.index'],
                            ['Inventory', 'inventory.index'],
                            ['Departments', 'departments.index'],
                        ];
                    @endphp

                    @foreach ($links as [$label, $route])
                        <a href="{{ route($route) }}"
                           class="px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 
                                  {{ request()->routeIs($route) 
                                     ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300 shadow-sm' 
                                     : 'text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            {{ __($label) }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex items-center space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button 
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium 
                                   bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 
                                   hover:bg-gray-200 dark:hover:bg-gray-700 
                                   focus:outline-none transition-all duration-150">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4 opacity-70" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="flex sm:hidden">
                <button @click="open = ! open" 
                    class="inline-flex items-center justify-center p-2 rounded-md 
                           text-gray-500 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 
                           hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" 
         class="hidden sm:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($links as [$label, $route])
                <x-responsive-nav-link :href="route($route)" :active="request()->routeIs($route)">
                    {{ __($label) }}
                </x-responsive-nav-link>
            @endforeach
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
