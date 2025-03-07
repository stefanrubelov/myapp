<x-wire-elements-modal current-route="product.view">
    <x-slot:body>
        {{ $this->infoList }}
    </x-slot:body>
    <x-slot:footer class="justify-center space-x-4">
        <x-anchor href="{{ route('product.view', ['product' => $product]) }}">
            Go to product
        </x-anchor>

        <x-anchor href="{{route('category.view', ['category' => $product->category])}}">
            Go to category
        </x-anchor>
    </x-slot:footer>
</x-wire-elements-modal>
