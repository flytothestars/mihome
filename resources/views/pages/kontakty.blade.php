<x-app-layout>
    <div x-data="page">
        <div class="container">
            <h1 class="uk-heading-line text-center text-2xl lg:text-4xl mb-5">
                {{ $page->getTranslatedAttribute('title') }}</h1>
        </div>
        <div class="container">
            <div class="prose max-w-none">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2.5 mb-4">
                    <div class="text-center">
                        <a class="uk-button uk-button-default" href="https://go.2gis.com/57o21n" rel="nofollow">Открыть
                            на
                            карте 2Gis</a>
                    </div>
                    <div class="text-center">
                        <a class="uk-button uk-button-default" href="https://goo.gl/maps/AVJCds6vcxrYsBE57"
                            rel="nofollow">Открыть в Google
                            Maps</a>
                    </div>
                </div>
                <div>
                    <iframe style="border: 1px solid #a3a3a3; box-sizing: border-box;"
                        src="https://widgets.2gis.com/widget?type=firmsonmap&amp;options=%7B%22pos%22%3A%7B%22lat%22%3A43.23918472989057%2C%22lon%22%3A76.90734386444093%2C%22zoom%22%3A16%7D%2C%22opt%22%3A%7B%22city%22%3A%22almaty%22%7D%2C%22org%22%3A%2270000001035172047%22%7D"
                        width="100%" height="600" frameborder="no"></iframe>
                </div>

                <h2 class="uk-heading-line text-center font-normal text-2xl xl:text-4xl"><span>График работы</span></h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2.5 mb-4 text-center">
                    <div class="el-item uk-card uk-card-default uk-card-body uk-margin-remove-first-child">
                        <h5 class="font-medium">Будние дни</h5>
                        <p>С 10.00 до 19.00</p>
                    </div>
                    <div class="el-item uk-card uk-card-default uk-card-body uk-margin-remove-first-child">
                        <h5 class="font-medium">Выходные дни</h5>
                        <p>С 10.00 до 19.00</p>
                    </div>
                </div>
                <h2 class="uk-heading-line text-center font-normal text-2xl xl:text-4xl"><span>Как пройти к
                        магазину</span></h2>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-2.5">
                    <div class="shadow rounded-lg px-5 py-5">
                        <h5 class="font-medium">Наш точный адрес</h5>
                        <div class="">
                            <p>050008, Республика Казахстан, город Алматы, <strong>улица 24 Июня, дом 27, БЦ
                                    "AizEX"</strong>, 1-ый этаж <ins>(район улиц Абая и Манаса)</ins>. Здание
                                находится по улице 24 июня, между улицами Абая и Мынбаева.</p>
                        </div>
                    </div>
                    <div class="shadow rounded-lg px-5 py-5">
                        <h5 class="font-medium">Дойти пешком</h5>
                        <div class="">
                            <p>Удобнее всего дойти от улицы Абая поднявшись <strong>по улице 24 июня</strong>.
                                Для этого необходимо между магазином AlcoMarket и аптекой Europharma повернуть в
                                сторону гор и пройти 100 метров. <ins>Дом 27 / БЦ "AizEX"</ins> будет справа от
                                вас (смотрите фото ниже).</p>
                        </div>
                    </div>
                    <div class="shadow rounded-lg px-5 py-5">
                        <h5 class="font-medium">Доехать на машине</h5>
                        <div class="">
                            <p>Заехать можно только с <strong>улицы Мынбаева</strong>, так как улица 24 июня
                                &ndash; односторонняя. Сразу после поворота с улицы Мынбаева &ndash; ищите место
                                для парковки. <ins>Дом 27 / БЦ "AizEX"</ins> находится на 100 метров ниже улицы
                                Мынбаева, по левой стороне.</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 my-8">
                    <div
                        class="relative after:block after:absolute after:w-full after:h-full after:bg-green-400 after:top-4 after:left-4">
                        <img src="/images/contacts1.webp" class="z-10 relative block m-0" alt="" />
                    </div>
                    <div
                        class="relative after:block after:absolute after:w-full after:h-full after:bg-green-400 after:top-4 after:left-4">
                        <img src="/images/contacts2.webp" class="z-10 relative block m-0" alt="" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
