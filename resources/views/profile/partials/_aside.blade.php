<a href="{{ route(app()->getLocale() . '.profile.edit') }}"
    class="flex justify-between gap-4 items-center px-4 py-3 bg-gray-100 rounded-t-lg border-b {{ $active === 'profile' ? 'text-green-500' : '' }} hover:text-green-500">
    <div class="flex gap-4 items-center">
        <svg class="w-6 h-6 " viewBox="0 0 24 24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 15C15.3137 15 18 12.3137 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9C6 12.3137 8.68629 15 12 15Z"
                stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
            <path
                d="M3 19.9998C3.91247 18.4796 5.22451 17.2172 6.8043 16.3396C8.3841 15.462 10.176 15 12.0001 15C13.8241 15 15.616 15.4621 17.1958 16.3397C18.7756 17.2174 20.0876 18.4797 21 20"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div>Профиль</div>
    </div>
    <svg class="w-6 h-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
</a>
<a href="{{ route(app()->getLocale() . '.profile.orders.index') }}"
    class="flex justify-between gap-4 items-center px-4 py-3 bg-gray-100 border-b {{ $active === 'orders' ? 'text-green-500' : '' }} hover:text-green-500">
    <div class="flex gap-4 items-center">
        <svg class="w-6 h-6 " viewBox="0 0 24 24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 15C15.3137 15 18 12.3137 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9C6 12.3137 8.68629 15 12 15Z"
                stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
            <path
                d="M3 19.9998C3.91247 18.4796 5.22451 17.2172 6.8043 16.3396C8.3841 15.462 10.176 15 12.0001 15C13.8241 15 15.616 15.4621 17.1958 16.3397C18.7756 17.2174 20.0876 18.4797 21 20"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div>Мои заказы</div>
    </div>
    <svg class="w-6 h-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
</a>
<a href="{{ route(app()->getLocale() . '.profile.favorites') }}"
    class="flex justify-between gap-4 items-center px-4 py-3 bg-gray-100 border-b {{ $active === 'favorites' ? 'text-green-500' : '' }} hover:text-green-500">
    <div class="flex gap-4 items-center">
        <svg class="w-6 h-6 " viewBox="0 0 24 24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 15C15.3137 15 18 12.3137 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9C6 12.3137 8.68629 15 12 15Z"
                stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
            <path
                d="M3 19.9998C3.91247 18.4796 5.22451 17.2172 6.8043 16.3396C8.3841 15.462 10.176 15 12.0001 15C13.8241 15 15.616 15.4621 17.1958 16.3397C18.7756 17.2174 20.0876 18.4797 21 20"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div>Избранные товары</div>
    </div>
    <svg class="w-6 h-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
</a>
<a href="{{ route(app()->getLocale() . '.password.change') }}"
    class="flex justify-between gap-4 items-center px-4 py-3 bg-gray-100 rounded-b-lg {{ $active === 'password' ? 'text-green-500' : '' }} border-b hover:text-green-500">
    <div class="flex gap-4 items-center">
        <svg class="w-6 h-6 " viewBox="0 0 24 24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 15C15.3137 15 18 12.3137 18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9C6 12.3137 8.68629 15 12 15Z"
                stroke="currentColor" stroke-width="2" stroke-miterlimit="10" />
            <path
                d="M3 19.9998C3.91247 18.4796 5.22451 17.2172 6.8043 16.3396C8.3841 15.462 10.176 15 12.0001 15C13.8241 15 15.616 15.4621 17.1958 16.3397C18.7756 17.2174 20.0876 18.4797 21 20"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div>Сменить пароль</div>
    </div>
    <svg class="w-6 h-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
</a>



@include('profile.partials.logout')
