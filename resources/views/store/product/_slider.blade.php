<div class="max-w-full lg:max-w-[12.75rem] xl:max-w-[19.25rem] flex sm:block">
    <div class="relative w-[calc(81.675%)] sm:w-full shrink-0 pb-2 pr-2 lg:pr-0">
        <a class="swiper-prev absolute top-1/2 -translate-y-1/2 -left-3 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
            href="#">
            <svg width="14" height="24" viewBox="0 0 14 24" class="-translate-x-px stroke-green-500">
                <polyline fill="none" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23">
                </polyline>
            </svg>
        </a>
        <div class="swiper" x-ref="slider">
            <div class="swiper-wrapper">
                @foreach ($offer && !empty($offer->webp) ? $offer->webp : $product->webp as $image)
                    @if ($image)
                        <div class="swiper-slide">
                            <div class="pt-[117.76%] bg-no-repeat bg-center bg-cover"
                                style="background-image:url('{{ $image[0] }}')"></div>
                            {{-- <img class="w-full" src="{{ $image[0] }}" alt=""> --}}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <a class="swiper-next absolute top-1/2 -translate-y-1/2 -right-3 z-10 flex justify-center items-center rounded-full w-10 h-10 border-2 border-[rgba(88,69,61,.5)] bg-white bg-opacity-80"
            href="#">
            <svg width="14" height="24" viewBox="0 0 14 24" class="translate-x-px stroke-green-500">
                <polyline fill="none" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1">
                </polyline>
            </svg>
        </a>
        <div class="swiper-pagination relative"></div>
    </div>
    <div class="flex flex-col justify-center sm:grid sm:grid-cols-4 lg:gap-2 shrink-0 grow">
        @foreach ($offer && !empty($offer->webp) ? $offer->webp : $product->webp as $key => $image)
            @php
                if ($key > 3) {
                    break;
                }
            @endphp
            @if (!empty($videoreviews) && $key === 3)
                @php
                    $videoreview = $videoreviews[0];
                    $regex =
                        '%(?:^youtube=|youtu\.be/?|youtube\.com/embed/?|youtube\.com\/watch\?v=)(?<id>[^/&\?]+)(?:\?|&amp;|&)?(?<query>.*)$%';

                    if (preg_match($regex, trim($videoreview), $match)) {
                        $videoreview = 'https://www.youtube.com/embed/' . $match['id'];
                        $videoreview .= '?wmode=transparent';
                        if ($match['query']) {
                            $videoreview .= 'query=' . $match['query'];
                        }
                    }
                @endphp
                <a data-modals href="{{ $videoreview }}" rel="nofollow" data-modals-height="100%"
                    class="block lg:pr-0 lg:pb-0 sm:hidden" data-modals-width="100%"
                    data-modals-group="modalvideo" data-modals-navigation="true">
                    <div class="pt-[117.76%] bg-no-repeat bg-center bg-cover relative"
                        style="background-image:url()">
                        <div
                            class="absolute top-0 left-0 bottom-0 right-0 flex items-center justify-center bg-white opacity-80">
                            <span uk-icon="icon: youtube; ratio: 2" style="color: red;"></span>
                        </div>
                    </div>
                </a>
            @endif
            @if ($image)
                <a data-fancybox="gallery" href="{{ isset($image[0]) ? $image[0] : '' }}"
                    class="pt-[117.76%] mb-2 bg-no-repeat bg-center bg-cover relative @if (!empty($videoreviews)) last:hidden sm:last:block @endif "
                    style="background-image:url('{{ $image[0] }}')">
                </a>
            @endif
        @endforeach
    </div>
    {{-- <div class="swiper ml-4 sm:ml-0 sm:my-5 grow max-h-[calc(100vw-5rem)]" x-ref="thumbs">
        <div class="swiper-wrapper">
            @foreach ($offer && !empty($offer->webp) ? $offer->webp : $product->webp as $image)
                @if ($image)
                    <div class="swiper-slide">
                        <img class="w-full" src="{{ $image[0] }}" alt="">
                    </div>
                @endif
            @endforeach
        </div>
    </div> --}}
</div>
