<ul class="flex flex-col lg:flex-row gap-2.5 m-0 pl-0">

    @php

        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }

    @endphp

    @foreach ($items as $item)
        @php

            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }

            $isActive = null;

            // Check if link is current
            if (url((app()->getLocale() === 'kz' ? '/kz' : '') . $item->link()) == url()->current()) {
                $isActive = 'text-green-500';
            }

        @endphp

        <li class="{{ $isActive }}">
            <a href="{{ app()->getLocale() === 'kz' ? '/kz' : '' }}{{ $item->link() }}" target="{{ $item->target }}"
                class="block p-2.5 shadow-lg rounded hover:text-green-500 transition {{ $isActive }} flex gap-2.5 items-center">
                @if ($item->icon_class)
                    @include('icons.' . $item->icon_class)
                @endif
                <span>{{ $item->title }}</span>
            </a>
        </li>
    @endforeach

</ul>
