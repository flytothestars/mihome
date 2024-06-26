<?php

/*
|--------------------------------------------------------------------------
| Voyager Shop Orders Translation File
|--------------------------------------------------------------------------
|
| In this translation file you will find all strings related to
| the orders.
|
*/

return [
    'label_singular' => 'Порядок',
    'label_plural' => 'Заказы',

    'data_rows' => [
        'id' => 'ID',
        'token' => 'Токен',
        'state' => 'Статус',
        'states' => [
            'cart' => 'Корзина',
            'pending' => 'В ожидании',
            'billed' => 'Выставлен счет',
            'canceled' => 'Отменено',
            'declined' => 'Отклонено',
            'refunded' => 'Возвратено',
        ],
        'project' => 'Проект',
        'user' => 'Пользователь',
        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
    ],

    /*
|----------------------------------------------------------------- - -------------------------
| Заказать услугу
|----------------------------------------------------------------- - -------------------------
|
| Строки для службы заказов.
|
*/

    'service' => [
        'buy-product-description' => 'Купить :product',
        'buy-cart-description' => 'Заказ на покупку #:id',
    ],
];
