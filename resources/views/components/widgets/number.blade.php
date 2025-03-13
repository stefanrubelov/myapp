<div
    {{ $attributes->merge(['class'=> 'flex flex-col rounded-lg bg-teal-50 px-3 py-4 text-center min-h-34 w-60']) }}
    x-data="{ current: 0, target: {{$number}}, time: 300}" x-init="() => {
                start = current;
                const interval = Math.max(time / (target - start), 5);
                const step = (target - start) /  (time / interval);
                const handle = setInterval(() => {
                    if(current < target)
                        current += step
                    else {
                        clearInterval(handle);
                        current = target
                    }
                    }, interval)
                }">
    <dt {{ $title->attributes->class(['order-last','text-md','font-medium', 'text-teal-700']) }}>
        {{ $title }}
    </dt>
    <div
        {{ $number->attributes->class(['text-2xl','font-extrabold','text-teal-700','md:text-5xl']) }} x-text="current">
    </div>
</div>
