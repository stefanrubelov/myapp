<header class="bg-slate-100 dark:bg-slate-800">
    <div class="mx-auto max-w-7xl">
        <div class="flex h-16 items-center justify-between">
            <div class="flex-1 md:flex md:items-center md:gap-12">
                @livewire('components.breadcrumbs')
            </div>

            <div class="md:flex md:items-center md:gap-12">
                <nav aria-label="Global" class="hidden md:block">
                    @auth
                        <ul class="flex items-center gap-6 text-sm">
                            <li>
                                <x-nav-link>
                                    Book
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link>
                                    Movies
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link>
                                    TV Shows
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link href="{{ route('expenses') }}">
                                    Expenses
                                </x-nav-link>
                            </li>
                            {{--                        <li>--}}
                            {{--                            <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> Careers </a>--}}
                            {{--                        </li>--}}

                        </ul>
                    @endauth
                </nav>

                <div class="hidden md:relative md:block">
                    @auth
                        <div x-data="{ open: false }"
                             @keyup.window.escape="open = false"
                             class="relative">
                            <button
                                type="button"
                                class="overflow-hidden rounded-full border border-gray-300 shadow-inner cursor-pointer"
                                @click="open = !open"
                            >
                                <span class="sr-only">Toggle dashboard menu</span>
                                <img
                                    src="{{ Auth::user()->getGravatarUrl()  }}"
                                    alt=""
                                    class="size-10 object-cover"
                                />
                            </button>

                            <div
                                x-cloak
                                x-show="open"
                                @click.outside="open = false"
                                x-transition
                                class="absolute end-0 z-10 mt-0.5 w-56 divide-y divide-gray-200 dark:divide-slate-500 rounded-lg border border-gray-100 dark:border-slate-500 bg-white dark:bg-slate-800 shadow-lg"
                                role="menu"
                            >
                                <div x-data="{
                                        activeTheme: localStorage.theme || 'system',
                                        currentTheme() {
                                            return this.activeTheme;
                                        },
                                        updateTheme(newTheme) {
                                            if (newTheme === 'system') {
                                                localStorage.removeItem('theme');
                                                this.activeTheme = 'system';
                                                this.isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                                            } else {
                                                localStorage.theme = newTheme;
                                                this.activeTheme = newTheme;
                                                this.isDark = newTheme === 'dark';
                                            }
                                        }
                                    }"
                                     @theme-changed.window="updateTheme($event.detail)"
                                     class="w-full flex flex-row items-center justify-evenly space-x-2 py-2">
                                    <button @click="updateTheme('light')"
                                            :class="{ 'bg-teal-400 text-zinc-900': currentTheme() === 'light', 'text-zinc-500 hover:bg-gray-200': currentTheme() !== 'light' }"
                                            class="p-2 rounded-lg transition-colors"
                                            type="button"
                                            data-tooltip-target="light-theme-tooltip"
                                            aria-label="Light mode">
                                        <span :class="{ 'text-slate-800': currentTheme() === 'light', 'hover:text-teal-600': currentTheme() !== 'light' }">
                                            <x-heroicon-c-sun class="size-6"/>
                                        </span>

                                    </button>
                                    <div id="light-theme-tooltip" role="tooltip"
                                         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-600 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-600">
                                        Enable light theme
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <button @click="updateTheme('dark')"
                                            :class="{ 'bg-teal-400 text-zinc-900': currentTheme() === 'dark', 'text-zinc-500 hover:bg-gray-200': currentTheme() !== 'dark' }"
                                            class="p-2 rounded-lg transition-colors"
                                            type="button"
                                            data-tooltip-target="dark-theme-tooltip"
                                            aria-label="Dark mode">
                                        <span :class="{ 'text-slate-800': currentTheme() === 'dark', 'hover:text-teal-600': currentTheme() !== 'dark' }">
                                            <x-heroicon-c-moon class="size-6"/>
                                        </span>
                                    </button>
                                    <div id="dark-theme-tooltip" role="tooltip"
                                         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-600 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-600">
                                        Enable dark theme
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <button @click="updateTheme('system')"
                                            :class="{ 'bg-teal-400 text-zinc-900': currentTheme() === 'system', 'text-zinc-500 hover:bg-gray-200': currentTheme() !== 'system' }"
                                            class="p-2 rounded-lg transition-colors"
                                            type="button"
                                            data-tooltip-target="system-theme-tooltip"
                                            aria-label="System theme">
                                        <span :class="{ 'text-slate-800': currentTheme() === 'system', 'hover:text-teal-600': currentTheme() !== 'system' }">
                                            <x-heroicon-c-computer-desktop class="size-6"/>
                                        </span>
                                    </button>
                                    <div id="system-theme-tooltip" role="tooltip"
                                         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-600 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-600">
                                        Enable system theme
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </div>

                                <div class="p-2">
                                    <a
                                        href="{{ route('profile') }}"
                                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 dark:text-white hover:bg-slate-100 hover:text-gray-700 dark:hover:text-slate-900"
                                        role="menuitem"
                                    >
                                        My profile
                                    </a>
                                    <a
                                        href="#"
                                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 dark:text-white hover:bg-slate-100 hover:text-gray-700 dark:hover:text-slate-900"
                                        role="menuitem"
                                    >
                                        Billing summary
                                    </a>
                                    <a
                                        href="#"
                                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 dark:text-white hover:bg-slate-100 hover:text-gray-700 dark:hover:text-slate-900"
                                        role="menuitem"
                                    >
                                        Team settings
                                    </a>
                                </div>

                                <div class="p-2">
                                    <form method="POST" action="#">
                                        <button
                                            type="submit"
                                            class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-gray-500 dark:text-white hover:bg-slate-100 dark:hover:text-slate-900 cursor-pointer"
                                            role="menuitem"
                                        >
                                            <x-heroicon-c-arrow-uturn-left class="size-4"/>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="sm:flex sm:gap-4">
                            <a
                                class="rounded-lg bg-teal-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm"
                                wire:navigate href="{{ route('login') }}"
                            >
                                Login
                            </a>

                            <div class="hidden sm:flex">
                                <a
                                    class="rounded-lg bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600"
                                    wire:navigate href="{{ route('register') }}"
                                >
                                    Register
                                </a>
                            </div>
                            @endauth
                        </div>

                        <div class="block md:hidden">
                            <button class="rounded-sm bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                        </div>
                </div>
            </div>
        </div>
</header>
