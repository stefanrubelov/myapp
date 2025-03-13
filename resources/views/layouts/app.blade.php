<!DOCTYPE html>
<html x-data="{
        theme: localStorage.theme || 'system',
        isDark: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
    }"
      :class="{ 'dark': isDark }"
      lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('images/application-icon.png') }}" type="image/png" sizes="512x512">

        <title>{{isset($title) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

        @filamentStyles
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        <script>
            if (
                localStorage.theme === 'dark' ||
                (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
            ) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body x-cloak class="antialiased bg-gray-100 dark:bg-slate-700">
    <div class="h-full">
        @livewire('components.header')
        @if(in_array(Route::currentRouteName(), ['home', 'profile']))
            @livewire('components.sidebar-menu.main-sidebar-menu')
        @endif
        @hasSection('body')
            @yield('body')
        @else
            <main class="max-w-7xl mx-auto flex-grow">
                {{ $slot }}
            </main>
        @endif
    </div>


        @filamentScripts
        @livewire('wire-elements-modal')
        @livewire('components.simple-notification')
        @livewire('components.footer')

        <script>
            document.addEventListener('livewire:init', () => {
                document.addEventListener('livewire:navigated', () => {
                    const theme = localStorage.theme || 'system';
                    const isDark = theme === 'dark' ||
                        (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);

                    if (isDark) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                });
            });
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (!localStorage.theme || localStorage.theme === 'system') {
                    if (e.matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            });
        </script>
    </body>
</html>
