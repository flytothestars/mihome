<ul class="m-0 pl-0">

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
            $icon = null;

            // Check if link is current
            if (url((app()->getLocale() === 'kz' ? '/kz' : '') . $item->link()) == url()->current()) {
                $isActive = 'text-green-500';
            }

            // Set Icon
            if (isset($options->icon) && $options->icon == true) {
                $icon = '<i class="' . $item->icon_class . '"></i>';
            }

        @endphp

        <li class="{{ $isActive }}">
            <a href="{{ app()->getLocale() === 'kz' ? '/kz' : '' }}{{ $item->link() }}" target="{{ $item->target }}"
                class="block p-1.5 hover:text-green-500 transition {{ $isActive }}">
                {!! $icon !!}
                <span>{{ $item->title }}</span>
            </a>
        </li>
    @endforeach

</ul>
