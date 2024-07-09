@if (Auth::check())
    <div class="product__block-content-item product__reviews-form-block">
        <livewire-comment-form product="{{ $product->id }}" />

        <div x-ref="dropzoneArea" class="dropzone my-4"></div>

        <div class="reviews-comments-item-form-footer my-4">
            <div class="reviews-comments-item-form-info mb-4">Перед отправкой отзыва убедитесь, что он не нарушает
                правил модерации: не содержит оскорблений и ссылок на сторонние ресурсы.
                <a href="/Article/6289/zarabatiyvaj_vmeste_s_sulpak_" target="_blank">Полные правила
                    модерации</a>;
            </div>

            <x-success-button type="submit" class="" form="comment-form">
                Разместить отзыв
            </x-success-button>
        </div>
    </div>
@else
    <div class="">
        <template x-if="reviews && reviews.data && reviews.data.length">
            <div>
                <h2 class="text-2xl font-bold">Отзывы покупателей
                    <span class="text-gray-400 relative -top-2 text-sm" x-text="reviews.meta.total"></span>
                </h2>
                <div class="product__reviews-main-block-left">
                    <div class="flex gap-6">
                        <div class="">
                            <h3 class="text-xl mb-2">Рейтинг</h3>
                            <div class="flex gap-1">
                                @for ($i = 0; $i < 5; ++$i)
                                    <svg width="20" height="20">
                                        <use
                                            xlink:href="/storage/icon_page-product.svg#star{{ $product->rate > $i ? '_active' : '' }}">
                                        </use>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <div class="">
                            <div class="text-2xl font-bold">{{ number_format($product->rate, 1, '.', ' ') }}</div>
                            <div class="text-gray-400">
                                {{ Lang::choice('отзыв|отзыва|отзывов', $product->ratecount, [], 'ru') }}</div>
                        </div>
                    </div>
                </div>
                <div class="py-6">
                    {{-- <div class="product__reviews-sorting-block">
            <a href="#comments__sorting"
                class="btn btn-all btn__white btn__block popup__link-js product__reviews-sorting-button">
                <svg width="14" height="12">
                    <use xlink:href="/storage/icons.svg#sorting"></use>
                </svg>
                <span>Сортировать</span>
            </a>
            <div class="product__reviews-sorting-wrapper">
                <div class="product__reviews-sorting-title">Показать по оценкам</div>
                <div class="product__reviews-sorting-items">

                    <a href="#" class="product__reviews-sorting-item option-add-class-active-js "
                        data-url="/Goods/Comments?goodId=5130&amp;classId=77&amp;page=1&amp;perPage=10&amp;sortType=DateInDescending&amp;filterType=Five&amp;isTab=True&amp;isPreview=False">
                        <span class="img">
                            <svg width="12" height="12">
                                <use xlink:href="/storage/icon_page-product.svg#star_active">
                                </use>
                            </svg>
                        </span>
                        5 (5)
                    </a>
                    <a href="#" class="product__reviews-sorting-item option-add-class-active-js "
                        data-url="/Goods/Comments?goodId=5130&amp;classId=77&amp;page=1&amp;perPage=10&amp;sortType=DateInDescending&amp;filterType=One&amp;isTab=True&amp;isPreview=False">
                        <span class="img">
                            <svg width="12" height="12">
                                <use xlink:href="/storage/icon_page-product.svg#star_active">
                                </use>
                            </svg>
                        </span>
                        1 (1)
                    </a>

                </div>
            </div>
            <a href="#" id="new-comment-button" class="btn btn-all btn__red">Добавить отзыв</a>
        </div> --}}
                    <template x-for="review in reviews.data">
                        <div class="my-6">
                            @include('store.product._reviews._new_review')
                        </div>
                    </template>
                    <template x-if="reviews.meta">
                        <div class="text-center my-6">
                            <div class="text-gray-400"></div>
                            <a href="#" class="border shadow bloc py-2 px-6 rounded"
                                x-on:click.prevent="loadReviews">Показать еще</a>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>
@endif
