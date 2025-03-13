<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb flex items-center gap-1 text-md text-gray-600 dark:text-white">
            @if($breadcrumbs)
                <li>
                    <a wire:navigate href="{{ route('home') }}" class="block transition hover:text-gray-700 dark:hover:text-white">
                        <span class="sr-only"> Home </span>
                        <x-heroicon-o-home class="size-6" />
                    </a>
                </li>
            @endif
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!$loop->last)
                    <li class="rtl:rotate-180">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="size-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </li>
                    <li class="breadcrumb-item">
                        <a wire:navigate href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                    </li>
                @else
                    <li class="rtl:rotate-180">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="size-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </li>
                    <li class="breadcrumb-item active block transition text-gray-700 dark:text-white font-medium" aria-current="page">
                        {{ $breadcrumb['title'] }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>


