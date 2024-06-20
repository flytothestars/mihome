<div x-data='filter({{ $minprice }}, {{ $maxprice }}, {!! json_encode($filter, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!})' class="select-none">
    <a href="#" x-on:click.prevent="filterOpened=true" x-show="!catalogShow"
        class="flex items-center justify-center p-1 rounded-l absolute right-0 top-32 z-30 bg-white shadow lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
        </svg>
    </a>
    <form class="p-1 bg-white rounded-lg overflow-hidden shadow-lg" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);" x-ref="filterform"
        x-bind:class="{ 'hidden lg:block': !filterOpened }"
        action="{{ $category ? $category->url : 'no-category' }}/filter">
        <div class="fixed lg:hidden inset-0 bg-black bg-opacity-25 z-30"></div>
        <div class="fixed lg:static inset-0 z-40 flex">
            <div
                class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl lg:shadow-none break-words">
                <div class="flex items-center justify-between px-4 lg:px-0 text-gray-900 mb-6">
                    <h2 class="text-lg font-bold">Фильтры</h2>
                    <button type="button" x-on:click="filterOpened=false"
                        class="lg:hidden -mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2">
                        <span class="sr-only">Закрыть</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="px-4 lg:px-0">
                    <div x-init="mintrigger();
                    maxtrigger()" class="relative border-b border-gray-200">
                        <div class="text-black">
                            <input type="range" step="100" x-bind:min="min"
                                x-bind:max="max" x-on:input="mintrigger" x-model="minprice"
                                class="absolute pointer-events-none appearance-none opacity-0 z-20 h-2 w-full cursor-pointer">
                            <input type="range" step="100" x-bind:min="min"
                                x-bind:max="max" x-on:input="maxtrigger" x-model="maxprice"
                                class="absolute pointer-events-none appearance-none opacity-0 z-20 h-2 w-full cursor-pointer">
                            <div class="relative z-10 h-2">
                                <div class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200">
                                </div>
                                <div class="absolute z-20 top-0 bottom-0 rounded-md bg-green-300"
                                    x-bind:style="'right:' + maxthumb + '%; left:' + minthumb + '%'"></div>
                                <div class="absolute z-30 w-6 h-6 top-0 left-0 bg-green-300 rounded-full -mt-2"
                                    :style="{ left: `${minthumb}%`, transform: `translateX(-${24*minthumb/100}px)` }">
                                </div>
                                <div class="absolute z-30 w-6 h-6 top-0 right-0 bg-green-300 rounded-full -mt-2"
                                    :style="{ right: `${maxthumb}%`, transform: `translateX(${24*maxthumb/100}px)` }">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-5">
                            <div>
                                <input type="text" maxlength="5" x-on:input="mintrigger" x-model="minprice"
                                    name="minprice" class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
                            </div>
                            <div>
                                <input type="text" maxlength="5" x-on:input="maxtrigger" x-model="maxprice"
                                    name="maxprice" class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
                            </div>
                        </div>
                    </div>
                </div>
                @if ($filters)
                    @foreach ($filters as $slug => $fltr)
                        @php
                            $title = $slug;
                            foreach ($properties as $property) {
                                if ($property['slug'] === $slug) {
                                    $title = $property['title'];
                                }
                            }
                        @endphp
                        <div class="border-b border-gray-200 py-6 px-4 lg:px-0" x-data="{ opened: false }">
                            <h3 class="-my-3 flow-root">
                                <!-- Expand/collapse section button -->
                                <button type="button"
                                    class="text-left flex w-full items-center justify-between bg-white py-3 text-sm text-gray-500 lg:opacity-70 hover:opacity-100"
                                    x-on:click="opened=!opened">
                                    <span class="font-bold text-base text-gray-900">{{ $title }}</span>
                                    <span class="ml-6 flex items-center">
                                        <!-- Expand icon, show/hide based on section open state. -->
                                        <svg class="h-5 w-5" x-show="!opened" style="display:none" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                        </svg>
                                        <!-- Collapse icon, show/hide based on section open state. -->
                                        <svg class="h-5 w-5" x-show="opened" style="display:none" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <!-- Filter section, show/hide based on section state. -->
                            <div x-show="opened" style="display:none" x-collapse.duration.300ms>
                                <div class="space-y-4 p-1 pt-6">
                                    @foreach ($fltr as $item)
                                        <div class="flex items-center">
                                            <input id="filter-{{ $slug }}-{{ $item['value'] }}"
                                                name="{{ $slug }}[]" value="{{ $item['value'] }}"
                                                x-on:change="applyFilter" type="checkbox"
                                                @if (isset($filter[$slug]) && in_array($item['value'], $filter[$slug])) checked="checked"
                                                x-init="opened=true" @endif
                                                class="h-4 w-4 rounded border border-gray-500 text-green-500 focus:ring-green-500">
                                            <label for="filter-{{ $slug }}-{{ $item['value'] }}"
                                                class="ml-3 text-sm text-gray-600">{{ $item['label'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <a href="{{ $category ? $category->url : '/store' }}">
            <x-secondary-button>
                Сбросить все фильтры
            </x-secondary-button>
        </a>
    </form>
</div>
