<a class="flex items-center gap-2 px-3 py-3 text-white transition bg-green-200 rounded hover:bg-green-250 xl:px-4"
    href="/cart">
    <svg width="20" height="20" viewBox="0 0 20 20">
        <circle cx="7.3" cy="17.3" r="1.4" fill="currentColor"></circle>
        <circle cx="13.3" cy="17.3" r="1.4" fill="currentColor"></circle>
        <polyline fill="none" stroke="currentColor" points="0 2 3.2 4 5.3 12.5 16 12.5 18 6.5 8 6.5">
        </polyline>
    </svg>
    <span class="hidden lg:block">Корзина - {{ $cart->sumText }} ₸</span>
</a>
