<div x-cloak x-data="sidebar()" class="relative flex items-start ">
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        class="fixed inset-0 z-30 bg-gray-100/50"
        @click="closeSidebar()"
        @keyup.window.escape="closeSidebar()"
    ></div>
    <div class="fixed top-0 transition-all duration-300">
        <div class="flex justify-end">
            <button
                x-show="!sidebarOpen"
                @click="sidebarOpen = !sidebarOpen"
                class="transition-all duration-300 h-16 h-16 p-1 mx-3 my-2 ml-12 mt-10 rounded-full outline-hidden">
                <svg class="h-16 h-16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M20 7L4 7" stroke="#616161" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M15 12L4 12" stroke="#616161" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M9 17H4" stroke="#616161" stroke-width="1.5" stroke-linecap="round"></path>
                    </g>
                </svg>
            </button>
        </div>
    </div>

    <div x-cloak wire:ignore :class="{'w-80': sidebarOpen, 'w-0': !sidebarOpen}"
         class="fixed z-50 top-0 bottom-0 left-0 z-30 block w-80 h-full min-h-screen overflow-y-auto text-gray-400 transition-all duration-300 ease-in-out bg-gray-100 shadow-lg overflow-x-hidden">
        <ul class="mt-6 space-y-1">
            <li>
                <div
                    class="block px-4 py-2 text-3xl text-gray-700 flex justify-between align-items-center">
                    <span>
                        Menu
                    </span>
                    <span class="w-10 h-10 fill-current mt-1 cursor-pointer" @click="closeSidebar()">
                        <x-icons.close-icon/>
                    </span>
                </div>
            </li>
            <li>
                <x-sidebar-menu-item :active="Route::currentRouteName() == 'expenses'" href="{{ route('expenses') }}">
                    General
                </x-sidebar-menu-item>
            </li>

            <li>
                <details class="group [&_summary::-webkit-details-marker]:hidden"
                         @if(in_array(Route::currentRouteName(), ['payments'])) open @endif>
                    <summary
                        class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="text-sm font-medium"> Payments </span>

                        <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="size-5"
                              viewBox="0 0 20 20"
                              fill="currentColor">
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"/>
                          </svg>
                        </span>
                    </summary>
                    <ul class="space-y-1 px-4">
                        <li>
                            <x-sidebar-menu-item :active="Route::currentRouteName() == 'payments'"
                                                 href="{{ route('payments') }}">
                                List of payments
                            </x-sidebar-menu-item>
                            <x-sidebar-menu-item :active="Route::currentRouteName() == ''" href="#">
                                Reports
                            </x-sidebar-menu-item>
                        </li>
                    </ul>
                </details>
            </li>

            <li>
                <x-sidebar-menu-item :active="Route::currentRouteName() == 'products'" href="{{ route('products') }}">
                    Products
                </x-sidebar-menu-item>
            </li>

            <li>
                <x-sidebar-menu-item :active="Route::currentRouteName() == 'merchants'" href="{{ route('merchants') }}">
                    Merchants
                </x-sidebar-menu-item>
            </li>

            <li>
                <details class="group [&_summary::-webkit-details-marker]:hidden"
                         @if(in_array(Route::currentRouteName(), ['categories'])) open @endif>
                    <summary
                        class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="text-sm font-medium"> Categories </span>

                        <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="size-5"
                              viewBox="0 0 20 20"
                              fill="currentColor">
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"/>
                          </svg>
                        </span>
                    </summary>
                    <ul class="space-y-1 px-4">
                        <li>
                            <x-sidebar-menu-item :active="Route::currentRouteName() == 'categories'"
                                                 href="{{ route('categories') }}">
                                List of categories
                            </x-sidebar-menu-item>
                            <x-sidebar-menu-item :active="Route::currentRouteName() == ''" href="#">
                                Category types
                            </x-sidebar-menu-item>
                        </li>
                    </ul>
                </details>
            </li>

            <li>
                <details class="group [&_summary::-webkit-details-marker]:hidden"
                         @if(in_array(Route::currentRouteName(), ['paymentMethods','transactionTypes'])) open @endif>
                    <summary
                        class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="text-sm font-medium"> Payment Settings </span>

                        <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                          <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="size-5"
                              viewBox="0 0 20 20"
                              fill="currentColor">
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"/>
                          </svg>
                        </span>
                    </summary>
                    <ul class="space-y-1 px-4">
                        <li>
                            <x-sidebar-menu-item :active="Route::currentRouteName() == 'paymentMethods'"
                                                 href="{{ route('paymentMethods') }}">
                                Payment methods
                            </x-sidebar-menu-item>
                            <x-sidebar-menu-item :active="Route::currentRouteName() == 'transactionTypes'"
                                                 href="{{ route('transactionTypes') }}">
                                Transaction types
                            </x-sidebar-menu-item>
                        </li>
                    </ul>
                </details>
            </li>

        </ul>

        <script>
            function sidebar() {
                return {
                    sidebarOpen: false,
                    sidebarProductMenuOpen: false,
                    openSidebar() {
                        this.sidebarOpen = true
                    },
                    closeSidebar() {
                        this.sidebarOpen = false
                    },
                    sidebarProductMenu() {
                        if (this.sidebarProductMenuOpen === true) {
                            this.sidebarProductMenuOpen = false
                            window.localStorage.setItem('sidebarProductMenuOpen', 'close');
                        } else {
                            this.sidebarProductMenuOpen = true
                            window.localStorage.setItem('sidebarProductMenuOpen', 'open');
                        }
                    },
                    checkSidebarProductMenu() {
                        if (window.localStorage.getItem('sidebarProductMenuOpen')) {
                            if (window.localStorage.getItem('sidebarProductMenuOpen') === 'open') {
                                this.sidebarProductMenuOpen = true
                            } else {
                                this.sidebarProductMenuOpen = false
                                window.localStorage.setItem('sidebarProductMenuOpen', 'close');
                            }
                        }
                    },
                }
            }
        </script>
    </div>
</div>


