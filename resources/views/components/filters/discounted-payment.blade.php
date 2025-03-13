<label class="block text-sm font-medium text-slate-800 dark:text-white">
    Price type
</label>
<label
    for="discountedOnly"
    class="peer flex cursor-pointer items-start gap-4 rounded-lg border border-gray-200 p-2 transition hover:bg-gray-50 dark:hover:bg-slate-900 dark:bg-slate-800 has-checked:bg-teal-100 dark:peer-has-checked:bg-slate-900 has-checked:border-teal-700"
>
    <div class="flex items-center">
        &#8203;
        <input wire:model.live="discountedOnly" type="checkbox"
               class="text-teal-700 size-4 rounded-md focus:ring-0 focus:ring-offset-0 checked:border-red-500 focus:outline-hidden"
               id="discountedOnly"/>
    </div>

    <div>
        <span class="font-sm text-gray-700 dark:text-slate-200">Discounted only</span>
    </div>
</label>
