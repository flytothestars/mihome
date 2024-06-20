<nav class="container overflow-x-auto whitespace-nowrap">
    <ul class="flex my-0 p-0 justify-between items-center -mx-4">
        @php
            $menuItems = [
                [
                    'title' => 'Обзор товара',
                    'anchor' => 'main',
                    'quan' => '',
                    'icon' => 'document',
                ],
                [
                    'title' => 'Описание',
                    'anchor' => 'description',
                    'quan' => '',
                    'icon' => 'document-text',
                ],
                [
                    'title' => 'Характеристики',
                    'anchor' => 'characteristics',
                    'quan' => '',
                    'icon' => 'list',
                ],
                [
                    'title' => 'Видео',
                    'anchor' => 'video',
                    'quan' => '',
                    'icon' => 'video-camera',
                ],
            ];

            !empty($product->instruction) &&
                ($menuItems[] = [
                    'title' => 'Инструкция',
                    'anchor' => 'instruction',
                    'quan' => '',
                    'icon' => 'document-text',
                ]);

            $menuItems[] = [
                'title' => 'Отзывы',
                'anchor' => 'reviews',
                'quan' => $product->reviews()->count(),
                'icon' => 'star',
            ];
        @endphp
        @foreach ($menuItems as $item)
            <li>
                <a href="#{{ $item['anchor'] }}"
                    class="px-4 py-3 flex items-center gap-2 group text-gray-600 hover:text-black border-b-2 border-transparent hover:border-red-500"
                    x-ref="anchor-{{ $item['anchor'] }}">
                    @switch($item['icon'])
                        @case('list')
                            <x-list-icon class="w-4 h-4 shrink-0" />
                        @break

                        @case('clipboard')
                            <x-clipboard-icon class="w-4 h-4 shrink-0" />
                        @break

                        @case('document-text')
                            <x-document-text-icon class="w-4 h-4 shrink-0" />
                        @break

                        @case('document')
                            <x-document-icon class="w-4 h-4 shrink-0" />
                        @break

                        @case('video-camera')
                            <x-video-camera-icon class="w-4 h-4 shrink-0" />
                        @break

                        @case('star')
                            <x-star-icon class="w-4 h-4 shrink-0" />
                        @break

                        @default
                            <x-list-icon class="w-4 h-4 shrink-0" />
                    @endswitch
                    <span class="">{{ $item['title'] }}</span>
                    <span class="text-[.625rem] relative -top-2">{{ $item['quan'] ?: '' }}</span>
                    @if ($item['anchor'] === 'reviews')
                        @if ($product->rating)
                            <span class="">⭐ {{ $product->rating }} /
                                {{ $product->ratingcount }}</span>
                        @endif
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</nav>
