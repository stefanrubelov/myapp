<div>
    <livewire:domains.expenses.homepage.monthly-spending-chart/>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-4">
        <article class="rounded-lg border border-gray-100 bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total spent</p>

                    <p class="text-2xl font-medium text-gray-900">{{$data['current_month']}} kr.</p>
                </div>
            </div>
            <div class="mt-1 flex gap-1 text-gray-900">
                <p class="flex gap-2 text-xs">
                    <span class="font-medium">{{ Carbon\Carbon::now()->format('F, Y') }}</span>
                </p>
            </div>
        </article>
        <article class="rounded-lg border border-gray-100 bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Last month</p>

                    <p class="text-2xl font-medium text-gray-900">{{$data['last_month']}} kr.</p>
                </div>
            </div>

            @if($data['current_month'] < $data['last_month'])
                <div class="mt-1 flex gap-1 text-green-600">
                    <x-heroicon-o-arrow-down class="size-4"/>
                    <p class="flex gap-2 text-xs">
                        <span class="font-medium"> {{ number_format($data['last_month'] / $data['current_month'] * 100, 2) }}%</span>
                    </p>
                </div>
            @else
                <div class="mt-1 flex gap-1 text-red-600">
                    <x-heroicon-o-arrow-up class="size-4"/>
                    <p class="flex gap-2 text-xs">
                        <span class="font-medium"> {{ number_format($data['current_month'] / $data['last_month'] * 100, 2) }}%</span>
                    </p>
                </div>
            @endif
        </article>
        <article class="rounded-lg border border-gray-100 bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Same month last year</p>

                    <p class="text-2xl font-medium text-gray-900">{{$data['current_month_last_year']}} kr.</p>
                </div>
            </div>

            @if($data['current_month'] < $data['current_month_last_year'])
                <div class="mt-1 flex gap-1 text-green-600">
                    <x-heroicon-o-arrow-down class="size-4"/>
                    <p class="flex gap-2 text-xs">
                        <span class="font-medium"> {{ number_format($data['current_month_last_year'] / $data['current_month'] * 100, 2) }}%</span>
                    </p>
                </div>
            @else
                <div class="mt-1 flex gap-1 text-red-600">
                    <x-heroicon-o-arrow-up class="size-4"/>
                    <p class="flex gap-2 text-xs">
                        <span class="font-medium"> {{ number_format($data['current_month'] / $data['current_month_last_year'] * 100, 2) }}%</span>
                    </p>
                </div>
            @endif
        </article>
    </div>
</div>
