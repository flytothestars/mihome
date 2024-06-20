@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }

@endphp
<ul class="flex items-center gap-4 xl:gap-10 m-0 p-0">
    @foreach ($items as $key => $item)
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

        <li class="relative items-center group @if ($key > 1 && $key < 4) hidden xl:flex @else flex @endif ">
            @if ($item->link() === '/store')
                <a href="{{ app()->getLocale() === 'kz' ? '/kz' : '' }}{{ $item->link() }}" target="{{ $item->target }}"
                    class="p-1.5 hover:text-green-500 transition flex gap-2.5 items-center {{ $isActive }}"
                    x-on:click.prevent="catalogShow=true">
                    @if ($item->icon_class)
                        @include('icons.' . $item->icon_class)
                    @endif
                    <span>{{ $item->title }}</span>
                </a>
            @else
                <a href="{{ app()->getLocale() === 'kz' ? '/kz' : '' }}{{ $item->link() }}" target="{{ $item->target }}"
                    class="p-1.5 hover:text-green-500 transition flex gap-2.5 items-center {{ $isActive }}">
                    @if ($item->icon_class)
                        @include('icons.' . $item->icon_class)
                    @endif
                    <span>{{ $item->title }}</span>
                </a>
                @if (!$originalItem->children->isEmpty())
                    @include('menu.subtop', [
                        'items' => $originalItem->children,
                        'options' => $options,
                    ])
                @endif
            @endif
        </li>
    @endforeach
</ul>
