 @php

     if (Voyager::translatable($items)) {
         $items = $items->load('translations');
     }

 @endphp


 <div
     class="hidden group-hover:block absolute bg-white z-10 left-0 top-full -mt-px p-4 bg-white shadow rounded min-w-[200px]">
     <ul class="flex flex-col gap-2 pl-8 list-disc m-0 pl-0">
         @foreach ($items as $item)
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

             <li>
                 <a href="{{ app()->getLocale() === 'kz' ? '/kz' : '' }}{{ $item->link() }}"
                     class="hover:text-green-500 {{ $isActive }}"><span>{{ $item->title }}</span></a>
             </li>
         @endforeach
     </ul>
 </div>
