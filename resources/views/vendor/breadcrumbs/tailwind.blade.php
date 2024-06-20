@unless ($breadcrumbs->isEmpty())
    <nav>
        <ol class="py-1 rounded flex flex-wrap text-sm text-gray-800 m-0 pl-0" itemscope
            itemtype="https://schema.org/BreadcrumbList">
            @php
                $cnt = 0;
            @endphp
            @foreach ($breadcrumbs as $key => $breadcrumb)
                @php
                    ++$cnt;
                @endphp
                @if ($breadcrumb->url && !$loop->last)
                    <li itemscope itemtype="https://schema.org/ListItem">
                        <a href="{{ $breadcrumb->url }}" itemprop="item"
                            class="hover:text-green-900 hover:underline focus:text-green-900 focus:underline @if (trim($breadcrumb->title) !== 'Home' && $cnt < count($breadcrumbs) - 1) hidden lg:block @endif">
                            @if (trim($breadcrumb->title) === 'Home')
                                <svg width="20" height="20" viewBox="0 0 20 20">
                                    <polygon points="18.65 11.35 10 2.71 1.35 11.35 0.65 10.65 10 1.29 19.35 10.65">
                                    </polygon>
                                    <polygon points="15 4 18 4 18 7 17 7 17 5 15 5"></polygon>
                                    <polygon
                                        points="3 11 4 11 4 18 7 18 7 12 12 12 12 18 16 18 16 11 17 11 17 19 11 19 11 13 8 13 8 19 3 19">
                                    </polygon>
                                </svg>
                                <span itemprop="name" style="display:none;">{!! $breadcrumb->title !!}</span>
                                <span itemprop="position" style="display:none;" content="{{ $cnt }}"></span>
                            @else
                                <span itemprop="name">{!! $breadcrumb->title !!}</span>
                                <span itemprop="position" content="{{ $cnt }}"></span>
                            @endif
                        </a>
                    </li>
                    @if (trim($breadcrumb->title) === 'Home')
                        <li class="text-gray-500 px-2 lg:hidden">></li>
                    @endif
                @else
                    <li class="hidden lg:block" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="item">
                            <span itemprop="name">{!! $breadcrumb->title !!}</span>
                            <span itemprop="position" content="{{ $cnt }}"></span>
                        </span>
                    </li>
                @endif

                @unless ($loop->last)
                    <li class="text-gray-500 px-2 hidden lg:block">></li>
                @endunless
            @endforeach
        </ol>
    </nav>
@endunless
