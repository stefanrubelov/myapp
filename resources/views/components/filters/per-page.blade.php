<label class="block text-sm font-medium text-gray-900 text-end">
    Per page
</label>
    <select
        wire:model.live="perPage"
        id="perPage"
        class="py-2.5 w-full rounded-lg border-gray-200 text-gray-700 sm:text-sm focus-within:border-teal-700 focus-within:ring-1 focus-within:ring-teal-700"
    >
        @foreach($perPageOptions as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>
