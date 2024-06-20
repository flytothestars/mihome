<form method="POST" class="my-6" action="{{ route(app()->getLocale() . '.logout') }}">
    @csrf
    <button
        class="w-full px-4 py-3 bg-gray-100 rounded-lg border-b hover:text-green-500"
        :href="route(app()->getLocale() . '.logout')"
        onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ __('Log Out') }}
    </button>
</form>
