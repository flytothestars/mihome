<div>
    @if (!empty($videoreviews))
        <div class="example-element mb-4">
            @foreach ($videoreviews as $key => $videoreview)
                <!-- START: Modals -->
                @php
                    $regex =
                        '%(?:^youtube=|youtu\.be/?|youtube\.com/embed/?|youtube\.com\/watch\?v=)(?<id>[^/&\?]+)(?:\?|&amp;|&)?(?<query>.*)$%';

                    if (!preg_match($regex, trim($videoreview), $match)) {
                        return $videoreview;
                    }

                    $videoreview = 'https://www.youtube.com/embed/' . $match['id'];
                    $videoreview .= '?wmode=transparent';
                    if ($match['query']) {
                        $videoreview .= 'query=' . $match['query'];
                    }

                @endphp
                <a data-modals href="{{ $videoreview }}" rel="nofollow" data-modals-height="100%" data-modals-width="100%"
                    data-modals-group="modalvideo" data-modals-navigation="true">
                    <div class="uk-inline uk-width-1-1 {{ $key ? 'uk-hidden' : 'uk-visible' }}">
                        @if (!empty($product->webp) && ($image = $product->webp[0]))
                            @if ($image)
                                <picture>
                                    <source type="image/webp" srcset="{{ $image[0] }} 732w"
                                        sizes="(min-width: 732px) 732px">
                                    <img class="uk-hidden@m" src="{{ $image[0] }}" width="732" height="862" alt
                                        loading="lazy">
                                </picture>
                                <div style="height: 100px; background: url({{ $image[0] }}); background-position: center; background-size: cover;"
                                    class="uk-visible@m"></div>
                            @endif
                        @endif
                        <div class="uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle"
                            style="padding: 20px;">
                            <div class="uk-grid-small uk-child-width-expand@s uk-flex-middle uk-text-center uk-flex-center uk-text-left@m uk-dark"
                                uk-grid>
                                <div class="uk-width-auto">
                                    <span uk-icon="icon: youtube; ratio: 2" style="color: red;"></span>
                                </div>
                                <div>Видео<span class="uk-visible@m">обзор
                                        на
                                        {!! $product->getTranslatedAttribute('name') !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <!-- END: Modals -->
            @endforeach
        </div>
    @endif
</div>
