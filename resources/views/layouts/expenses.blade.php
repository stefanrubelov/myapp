@extends('layouts.app')

@section('body')
    @livewire('components.sidebar-menu.expenses-sidebar-menu')
    <main class="max-w-7xl mx-auto min-h-screen">
        <div class="mt-4">
            {{ $slot }}
        </div>
    </main>
@endsection
