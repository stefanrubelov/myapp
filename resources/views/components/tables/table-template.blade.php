<div class="rounded-lg border border-gray-200 dark:border-slate-400 mt-4">
    <table class="rounded-lg min-w-full divide-y-2 divide-gray-200 dark:divide-slate-400 bg-white dark:bg-slate-900 text-sm">
        <thead class="ltr:text-left rtl:text-right">
            <tr class="bg-gray-50 dark:bg-slate-900">
                {{$head}}
            </tr>
        </thead>

        <tbody {{ $body->attributes->merge(['class' => 'divide-y divide-gray-200 last:bg-red-500']) }}>
            {{ $body }}
        </tbody>
    </table>
</div>
