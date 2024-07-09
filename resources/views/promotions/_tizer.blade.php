<div class="flex flex-col bg-white rounded-lg overflow-hidden shadow-lg">
    <div class="relative flex">
        <a href="{{ $tizer->link }}" class="bg-slate-100 w-full block pt-[117.76%] bg-cover bg-center"
            style="background-image:url('{{ Voyager::image($tizer->image) }}')">
        </a>
    </div>
    <div class="pt-5 text-center grow" style="padding: 5px;">
        <a href="{{ $tizer->link }}"
            class="mb-3 block font-bold text-xl">{{ $tizer->getTranslatedAttribute('title') }}</a>

        <div class="mb-3 text-xs opacity-60"> Действует до:
            {!! \Illuminate\Support\Carbon::parse($tizer->active_to)->isoFormat('LL') !!}</div>
        <div class="mb-3 text-sm">
            {!! $tizer->getTranslatedAttribute('text') !!}</div>

        <a href="{{ $tizer->link }}" class="el-link uk-button uk-button-default" style="margin: 5px;">Перейти к товарам</a>
    </div>
</div>
