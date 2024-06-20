<script defer>
    if (document.getElementById('shipping')) {
        var endpoint = 'https://pro.ip-api.com/json/?fields=country,city&lang=ru&key=xMc2RMjFEk2swhC';
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                var price = "{{ $product->price }}";
                var weight = "{{ (float) $product->weight }}";
                if (response.country == 'Казахстан') {
                    if (response.city == 'Алматы') {

                        var hhmm = new Date().toLocaleTimeString('ru', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        if (hhmm <= '08:59') {
                            if (price > 9990) {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>Cегодня</b> доставим по Алматы, бесплатно')
                                }, 1000)
                            } else {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>Cегодня</b> доставим по Алматы')
                                }, 1000)
                            }
                        } else if (hhmm <= '10:59') {
                            if (price > 9990 && price < 19990) {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>Сегодня</b> доставим по Алматы, бесплатно')
                                }, 1000)
                            } else if (price > 19990) {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>За 3 часа</b> доставим по Алматы, бесплатно')
                                }, 1000)
                            } else {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>Cегодня</b> доставим по Алматы')
                                }, 1000)
                            }
                        } else if (hhmm <= '16:59') {
                            if (price > 9990 && price < 19990) {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>Завтра</b> доставим по Алматы, бесплатно')
                                }, 1000)
                            } else if (price > 19990) {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>За 3 часа</b> доставим по Алматы, бесплатно')
                                }, 1000)
                            } else {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>Завтра</b> доставим по Алматы')
                                }, 1000)
                            }
                        } else if (hhmm <= '23:59') {
                            if (price > 9990) {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>Завтра</b> доставим по Алматы, бесплатно')
                                }, 1000)
                            } else {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = (
                                        '<b>Завтра</b> доставим по Алматы')
                                }, 1000)
                            }
                        }

                    } else {
                        var cityies_expr = new Map([
                            ["Балхаш", "4-7 дней"],
                            ["Караганда", "2-3 дня"],
                            ["Астана", "1-3 дня"],
                            ["Кокшетау", "1-3 дня"],
                            ["Костанай", "1-3 дня"],
                            ["Актобе", "2-3 дня"],
                            ["Уральск", "2-3 дня"],
                            ["Атырау", "2-3 дня"],
                            ["Актау", "2-3 дня"],
                            ["Кызылорда", "1-3 дня"],
                            ["Шымкент", "1-3 дня"],
                            ["Тараз", "1-3 дня"],
                            ["Талдыкорган", "1-3 дня"],
                            ["Усть-Каменогорск", "2-3 дня"],
                            ["Семей", "1-3 дня"],
                            ["Павлодар", "1-3 дня"],
                            ["Экибастуз", "2-3 дня"],
                            ["Петропавловск", "2-4 дня"],
                            ["Жезказган", "4-7 дней"],
                            ["Туркестан", "4-7 дней"],
                            ["Степногорск", "4-7 дней"]
                        ]);

                        var cityies_stand = new Map([
                            ["Балхаш", "7-9 дней"],
                            ["Караганда", "6-8 дней"],
                            ["Астана", "6-8 дней"],
                            ["Кокшетау", "7-9 дней"],
                            ["Костанай", "7-9 дней"],
                            ["Актобе", "7-9 дней"],
                            ["Уральск", "7-9 дней"],
                            ["Атырау", "7-9 дней"],
                            ["Актау", "7-9 дней"],
                            ["Кызылорда", "7-9 дней"],
                            ["Шымкент", "7-9 дней"],
                            ["Тараз", "7-9 дней"],
                            ["Талдыкорган", "7-9 дней"],
                            ["Усть-Каменогорск", "7-9 дней"],
                            ["Семей", "7-9 дней"],
                            ["Павлодар", "7-9 дней"],
                            ["Экибастуз", "7-9 дней"],
                            ["Петропавловск", "7-9 дней"],
                            ["Жезказган", "8-12 дней"],
                            ["Туркестан", "8-12 дней"],
                            ["Степногорск", "8-12 дней"]
                        ]);

                        var pat_city = response.city;

                        if (price > 19990) {
                            var freedelivery = "<b>Бесплатно</b>";
                        } else {
                            var freedelivery = "";
                        }

                        if (weight < 1) {
                            if (cityies_expr.has(pat_city)) {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = ('доставим до ' +
                                        pat_city +
                                        ' <b>За ' + cityies_expr.get(pat_city) + '</b> ' + freedelivery)
                                }, 1000)
                            } else {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = ('доставим до ' +
                                        pat_city +
                                        ' <b>За 4-12 дней</b> ' + freedelivery)
                                }, 1000)
                            }
                        } else {
                            if (cityies_stand.has(pat_city)) {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = ('доставим до ' +
                                        pat_city +
                                        ' <b>За ' + cityies_stand.get(pat_city) + '</b> ' + freedelivery
                                    )
                                }, 1000)
                            } else {
                                setTimeout(function() {
                                    document.getElementById('shipping').innerHTML = ('доставим до ' +
                                        pat_city +
                                        ' <b>За 8-12 дней</b> ' + freedelivery)
                                }, 1000)
                            }
                        }
                    }
                } else {
                    setTimeout(function() {
                        document.getElementById('shipping').innerHTML = (
                            'Мы доставляем только <br/>по <b>Казахстану</b>')
                    }, 1000)
                }
            }
        };
        xhr.open('GET', endpoint, true);
        xhr.send();
    }
</script>

@if ($product->in_stock != 0)
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-3 my-3 lg:my-5 text-xs lg:text-base">
        <div>
            <svg class="w-3 lg:w-5 h-3 lg:h-5 inline" viewBox="0 0 20 20">
                <polyline fill="none" stroke="currentColor" stroke-width="1.03" points="7 4 13 10 7 16"></polyline>
            </svg>
            <span id="shipping"><b>Вычисляем</b> сроки доставки...</span>
            <svg class="inline cursor-pointer w-4 h-4 text-green-500 hover:text-green-800"
                onclick="Livewire.dispatch('openModal', { component: 'modals.delivery' })" viewBox="0 0 20 20">
                <path
                    d="M12.13,11.59 C11.97,12.84 10.35,14.12 9.1,14.16 C6.17,14.2 9.89,9.46 8.74,8.37 C9.3,8.16 10.62,7.83 10.62,8.81 C10.62,9.63 10.12,10.55 9.88,11.32 C8.66,15.16 12.13,11.15 12.14,11.18 C12.16,11.21 12.16,11.35 12.13,11.59 C12.08,11.95 12.16,11.35 12.13,11.59 L12.13,11.59 Z M11.56,5.67 C11.56,6.67 9.36,7.15 9.36,6.03 C9.36,5 11.56,4.54 11.56,5.67 L11.56,5.67 Z"
                    fill="currentColor">
                </path>
                <circle fill="none" stroke="currentColor" stroke-width="1.1" cx="10" cy="10" r="9">
                </circle>
            </svg>
        </div>
        <div>
            {!! $product->discountText !!}
        </div>
    </div>
@elseif($product->price != 0)
    <div class="my-3 lg:my-5">Нажмите на кнопку <strong>Предзаказ</strong> ниже чтобы получить
        <ins>SMS&nbsp;уведомление</ins> о поступлении
        товара
    </div>
@else
    <div class="my-3 lg:my-5">Товар <strong>Снят с производства</strong> и поступать больше
        <ins>не&nbsp;будет</ins>
    </div>
@endif
