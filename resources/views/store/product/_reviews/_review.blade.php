<div class="space-y-6">
    <div class="rounded border px-6 py-4">
        <div class="flex gap-4 items-center text-xs font-medium">
            <div class="product__reviews-comments-item-name">
                <span>
                    <svg width="18" height="18">
                        <use xlink:href="/storage/icon_page-product.svg#Already-bought">
                        </use>
                    </svg>
                </span>

            </div>
            <div class="grow flex gap-4 items-center">

                <div class="font-bold text-lg">5.0</div>
                <div class="flex gap-2">
                    <svg width="12" height="12">
                        <use xlink:href="/storage/icons.svg#star_active">
                        </use>
                    </svg>
                    <svg width="12" height="12">
                        <use xlink:href="/storage/icons.svg#star_active">
                        </use>
                    </svg>
                    <svg width="12" height="12">
                        <use xlink:href="/storage/icons.svg#star_active">
                        </use>
                    </svg>
                    <svg width="12" height="12">
                        <use xlink:href="/storage/icons.svg#star_active">
                        </use>
                    </svg>
                    <svg width="12" height="12">
                        <use xlink:href="/storage/icons.svg#star_active">
                        </use>
                    </svg>
                </div>
            </div>
            <div class="text-gray-400"  x-text="moment(review.created_at).format('DD.MM.YYYY')"></div>
        </div>

        <div class="text-sm py-3">
            <div class="" x-text="review.text"></div>
            <div class="">

                <div class="my-3 grid grid-cols-4">
                    <div class="text-gray-400">Плюсы:</div>
                    <div class="col-span-3" x-text="review.advantages"></div>
                </div>

                <div class="my-3 grid grid-cols-4">
                    <div class="text-gray-400">Минусы:</div>
                    <div class="col-span-3" x-text="review.disadvantages"></div>
                </div>
                {{-- id, published, product_id, user_id, name, advantages, disadvantages, text, rate, created_at, updated_at, deleted_at --}}
            </div>
            <div class="product__reviews-media-items">


            </div>
        </div>
    </div>
</div>
