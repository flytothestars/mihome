<x-app-layout>
    <div class="container">
        <div class="prose max-w-none">
            <h1 class="uk-heading-line text-center"> <span>Полезная информация</span> </h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 lg:grid-cols-3 gap-2.5">
                @foreach ($pages as $page)
                    @if (isset($page['url']) && isset($page['title']))
                        <div
                            class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
                            <h3 class="el-title uk-h5 uk-heading-bullet uk-margin-top uk-margin-remove-bottom">
                                <a href="{{ $page['url'] }}" class="uk-link-reset">{{ $page['title'] }}</a>
                            </h3>
                        </div>
                    @else
                        @dd($page);
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
