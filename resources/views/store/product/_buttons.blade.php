@if ((!$offer && $product->in_stock) || ($offer && $offer->in_stock))
    <div class="z-20 fixed bottom-0 w-full left-0 lg:static grid grid-cols-3 gap-3 p-5 lg:rounded-lg bg-green-300">
        @include('store.product._buttons._cart', ['product' => $offer ? $offer : $product])
        @include('store.product._buttons._favorite', ['product' => $offer ? $offer : $product])       
        @include('store.product._buttons._kaspi')
    </div>
@elseif($product->price != 0)
    <div class="z-20 fixed bottom-0 w-full left-0 lg:static grid grid-cols-2 gap-2 p-5 lg:rounded-lg bg-green-300">
        @include('store.product._buttons._preorder')
        
    </div>
@else
@endif
