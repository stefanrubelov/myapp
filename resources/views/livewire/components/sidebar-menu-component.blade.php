<div x-cloak x-data="sidebar()" class="relative flex items-start" @mousemove.window="handleMouseMove($event)">
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 z-30 bg-gray-100/50 dark:bg-gray-500/50"
        @click="closeSidebar()"
        @keyup.window.escape="closeSidebar()"
    ></div>

    <div x-cloak
         wire:ignore
         :class="{'w-80': sidebarOpen, 'w-0': !sidebarOpen}"
         @mouseleave="closeSidebar()"
         class="fixed z-50 top-0 bottom-0 left-0 z-30 block w-80 h-full min-h-screen overflow-y-auto text-slate-700 transition-all duration-300 ease-in-out bg-gray-50 dark:bg-slate-800 shadow-lg overflow-x-hidden shadow-lg">
        <div class="block px-4 py-2 text-3xl text-slate-700 dark:text-white flex justify-between items-center mt-2">
            <span>
                Menu
            </span>
            <span class="w-10 h-10 text-slate-700 cursor-pointer dark:fill-white dark:text-white" @click="closeSidebar()">
                <x-heroicon-o-x-circle/>
            </span>
        </div>
        <nav class="px-3 py-4 space-y-1">
            @foreach($menuItems as $item)
                @if($item['type'] === 'item')
                    {{-- Single Menu Item --}}
                    <a
                        wire:navigate
                        href="{{ $item['url'] ?? '#' }}"
                        class="flex items-center px-3 py-2.5 text-sm font-medium text-slate-700 dark:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-slate-900 {{ $item['isActive'] ? 'bg-gray-200 text-gray-900 dark:bg-slate-900' : '' }}"
                    >
                        @if($item['icon'])
                            <x-dynamic-component
                                :component="$item['icon']"
                                class="w-5 h-5 mr-3 text-slate-700 dark:text-white"
                            />
                        @endif
                        {{ $item['title'] }}
                    </a>
                @else
                    {{-- Group Item --}}
                    <div x-data="{ open: '{{$item['hasActiveItems']}}' }">
                        <button
                            @click="open = !open"
                            class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-slate-700 dark:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-slate-900 group cursor-pointer"
                        >
                            <div class="flex items-center">
                                @if($item['icon'])
                                    <x-dynamic-component
                                        :component="$item['icon']"
                                        class="w-5 h-5 mr-3 text-slate-700 dark:text-white"
                                    />
                                @endif
                                {{ $item['title'] }}
                            </div>
                            <div :class="{'rotate-180': open}">
                                <x-heroicon-o-chevron-down
                                    class="size-5 text-slate-700 dark:text-teal-500 transition-transform duration-200"/>
                            </div>
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 -translate-y-2"
                            x-transition:enter-end="transform opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="transform opacity-100 translate-y-0"
                            x-transition:leave-end="transform opacity-0 -translate-y-2"
                        >
                            @foreach($item['items'] as $subItem)
                                <a
                                    wire:navigate
                                    href="{{ $subItem['url'] ?? '#' }}"
                                    class="flex items-center pl-11 pr-3 py-2.5 my-1 text-sm font-medium text-slate-700 dark:text-white rounded-lg {{ $subItem['isActive'] ? 'bg-gray-200 text-gray-900 dark:bg-slate-900' : 'hover:bg-gray-100 dark:hover:bg-slate-900' }}"
                                >
                                    @if($subItem['icon'])
                                        <x-dynamic-component
                                            :component="$subItem['icon']"
                                            class="w-5 h-5 mr-3 text-slate-700 dark:text-white"
                                        />
                                    @endif
                                    {{ $subItem['title'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>
        <script>
            function sidebar() {
                return {
                    sidebarOpen: false,
                    sidebarProductMenuOpen: false,
                    edgeThreshold: 15, // Distance from edge to trigger sidebar (px)
                    handleMouseMove(event) {
                        if (event.clientX <= this.edgeThreshold && !this.sidebarOpen) {
                            this.openSidebar();
                        }
                    },
                    openSidebar() {
                        this.sidebarOpen = true;
                    },
                    closeSidebar() {
                        this.sidebarOpen = false;
                    },
                    sidebarProductMenu() {
                        if (this.sidebarProductMenuOpen === true) {
                            this.sidebarProductMenuOpen = false;
                            window.localStorage.setItem('sidebarProductMenuOpen', 'close');
                        } else {
                            this.sidebarProductMenuOpen = true;
                            window.localStorage.setItem('sidebarProductMenuOpen', 'open');
                        }
                    },
                    checkSidebarProductMenu() {
                        if (window.localStorage.getItem('sidebarProductMenuOpen')) {
                            if (window.localStorage.getItem('sidebarProductMenuOpen') === 'open') {
                                this.sidebarProductMenuOpen = true;
                            } else {
                                this.sidebarProductMenuOpen = false;
                                window.localStorage.setItem('sidebarProductMenuOpen', 'close');
                            }
                        }
                    },
                }
            }
        </script>
    </div>
</div>
