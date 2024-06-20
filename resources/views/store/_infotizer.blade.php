<div class="flex flex-col bg-white rounded-lg shadow-lg rounded-lg overflow-hidden">
    <div class="relative flex">
        <a href="{{ $tizer->url }}" class="bg-slate-100 w-full block pt-[117.76%] bg-cover bg-center"
            style="background-image:url('{{ $tizer->images && $tizer->images->count() ? Voyager::image($tizer->images[0]->link) : 'no-photo' }}')">
        </a>
    </div>
    <div class="p-1 pt-5 text-center grow">
        <a href="{{ $tizer->url }}"
            class="block h-12 mb-5 text-ellipsis line-clamp-2">{{ $tizer->getTranslatedAttribute('name') }}</a>
        <div class="mb-5 text-sm text-ellipsis overflow-hidden whitespace-nowrap">{{ $tizer->getTranslatedAttribute('description') }}</div>
        <div class="flex items-center justify-between lg:justify-center gap-1 lg:gap-6">
            @if ($tizer->old_price && $tizer->old_price > $tizer->price)
                <strong
                    class="block mb-5 font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap">{{ number_format($tizer->price, 0, '.', ' ') . ' ₸' }}</strong>
                <del
                    class="block mb-5 -tracking-[0.5px] whitespace-nowrap">{{ number_format($tizer->old_price, 0, '.', ' ') . ' ₸' }}</del>
            @else
                <strong
                    class="block mb-5 font-semibold text-green-300 -tracking-[0.5px] whitespace-nowrap">{{ number_format($tizer->price, 0, '.', ' ') . ' ₸' }}</strong>
            @endif
        </div>
    </div>
</div>
