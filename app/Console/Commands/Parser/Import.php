<?php

namespace App\Console\Commands\Parser;

use App\Models\Offer;
use App\Models\Preorder;
use App\Models\Product;
use App\Models\User;
use App\Notifications\FailSmsNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Mobizon\MobizonApi;

class Import extends Command
{
    public $start,
        $webi_depth = 0,
        $vendor_id = 1,
        $webi_tag_open,
        $attrs_cats,
        $kaspi_brands = ['BSP10', 'Meizu', 'OnePlus', 'Sony', 'Xiaomi', 'Kingston', 'Gearmax'],
        $path_tags,
        $obj,
        $cat,
        $data_array,
        $array,
        $count_update;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dump('Скрипт запущен');
        $this->start = now();
        $host = "185.98.5.218";
        $connect = ftp_connect($host);
        $user = "v-9789_upload";
        $password = "iR?38ye8";
        // ftp_login($connect, $user, $password);
        @Storage::makeDirectory('/tmp');
        @Storage::makeDirectory('/cache');
        $dest = Storage::path('/tmp/OstatkiSaitNew.xml');
        $newfile =  Storage::path('/cache/OstatkiSaitNew.xml');
        // ftp_get($connect, $newfile, '/upload/OstatkiSaitNew.xml',  FTP_BINARY);

        Storage::put($dest, preg_replace('/^<items>(.+)$/', '<items>', Storage::get($dest)));
        if (1 || md5_file($newfile) != md5_file($dest)) {
            //     copy($newfile, $dest);
            //     unlink($newfile);
            self::webi_xml($dest);
            foreach (Offer::where('exchange', '<', $this->start)->orWhereNull('exchange')->get() as $offer) $offer->delete();
            // self::exportKaspiXml();
            // self::exportKaspiBotXml();
            // self::exportFacebookXml();
            self::checkProducts();
            dump('Импорт прошел успешно!');
        } else {
            dump('Файл старый! Импорт не прошел!');
        }
    }

    public function checkProducts()
    {
        foreach (Product::whereDoesntHave('offers', function ($query) {
            $query->where('price', '>', '0')->orWhere('kaspi', '>', '0')->orWhere('pre_order', '>', '0');
        })->get() as $product) {
            dump($product->name);
            $product->delete();
        }
    }

    public function webi_xml($file)
    {
        $this->count_update = 0;

        $reader = new \XMLReader();
        $reader->open($file);

        while ($reader->read()) {
            if ($reader->nodeType == \XMLReader::END_ELEMENT) continue;
            if ($reader->name == 'item') {
                $xml = simplexml_load_string($reader->readOuterXml());
                $this->readElement($xml);
            }
        }

        dump('Всего товаров обработано: ' . $this->count_update);
    }

    public function readElement($xml)
    {
        // <item>
        //     <kaspi>0</kaspi> - 0/1 доступна ли рассрочка каспи
        //     <halyk/> - 0/1 пока не учитывать
        //     <id>YNDX-00020-RED</id> артикул
        //     <name>Яндекс Станция Mini Plus - Red (Красный)</name>
        //     <rrp>0</rrp> - не учитывать
        //     <balance>3</balance> - остаток
        //     <balance_pre>0</balance_pre> - не учитывать
        //     <pre_order>0</pre_order> - кол-во дней  Ожидаем через 46 дн.
        //     <price>44990</price> основная цена
        //     <price_basic>0</price_basic> старая цена
        //     <price_min>46990</price_min>  - не учитывать
        //     <weight>0,53</weight> - вес
        // </item>

        $product = Offer::where('article', (string)$xml->id)->first();
        if (!$product) {
            dump('нет товара ' . (string)$xml->id . ' ' . (string)$xml->name);
            return;
        }

        $product->product->restore();

        $product->exchange = $this->start;

        $product->kaspi = (int)$xml->kaspi;
        $product->halyk = (int)$xml->halyk;

        // $product->name = (string)$xml->name;
        $product->pre_order = (int)$xml->pre_order;
        $product->rrp = (int)$xml->rrp;

        $product->in_stock = (string)$xml->balance;
        $product->in_stock_pre = (string)$xml->balance_pre;

        $product->weight = (float)str_replace(",", ".", (string)$xml->weight);
        $product->product->weight = (float)$product->weight;

        if (false && $product->in_stock == 0 && $product->alstyle != null) {
            // $dataAlStyle = $this->getAlStyleProduct($product);
            // dump('наличиее у Вендера: ' . $dataAlStyle[$product->alstyle]['quantity'] . ', ');
            // if ((str_replace('>', '', $dataAlStyle[$product->alstyle]['quantity'])) > 3 and ($dataAlStyle[$product->alstyle]['price2'] / $dataAlStyle[$product->alstyle]['price1']) > 1.17) {
            //     $product->stock = !0;
            //     $product->in_stock = 1;
            //     $product->ordered = 0; // 'Наличие Под заказ выставили на сайте
            //     $product->price = $dataAlStyle[$product->alstyle]['price2'];
            //     $product->old_price = $dataAlStyle[$product->alstyle]['price2']; // - выставили цену от Вендер
            // } else {
            //     $product->in_stock = 0;
            //     $product->stock = 1;
            //     $product->ordered = 0; // 'Под заказ не продаем
            // }
        } else {
            $product->ordered = 0;
            $product->old_price = (float)$xml->price_basic;
            $product->price = (float)$xml->price;
        }

        if ($product->in_stock > 0) $this->sendSms($product);

        $this->count_update++;

        $product->save();
        $product->product->save();
    }

    public function sendSms($product)
    {

        /*Скрипт отправки уведомлений о появлении товара*/

        $body = "Mi-Home.kz - Товар " . $product->name . " поступил на склад. Ссылка " . route('ru.product', [
            'product' => $product->slug
        ]);

        $phones = Preorder::where('offer_id', $product->id)->where('sent', 0)->get();
        $api = new MobizonApi('kz9d929fa071697c63a2393dac009c2f2f0bc875fa5febeffa19c3b22c199b3da84e5e', 'api.mobizon.kz');
        foreach ($phones as $i => $phone) {
            if ($api->call(
                'message',
                'sendSMSMessage',
                array(
                    'recipient' => self::phone($phone->phone),
                    'text' => $body
                )
            )) {
            } else {
                self::notify('An error occurred while sending message: [' . $api->getCode() . '] ' . $api->getMessage());
                dump(array($api->getCode(), $api->getData(), $api->getMessage()));
            };
            $phone->sent = now();
            $phone->save();
            dump($body . ' - отправили смс, ' . $phone);
        }
        /*Конец скрипта отправки уведомлений о появлении товара*/
    }

    public function exportKaspiXml()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= PHP_EOL . '<kaspi_catalog date="string" xmlns="kaspiShopping" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="kaspiShopping http://kaspi.kz/kaspishopping.xsd">';
        $xml .= PHP_EOL . '<company>Bonanza Trading Company</company>';
        $xml .= PHP_EOL . '<merchantid>voxm</merchantid>';
        $xml .= PHP_EOL . '<offers>';

        $kaspi_qty = 0;

        foreach (Offer::where('in_stock', '>', 0)->get() as $offer) {

            if (
                (float)$offer->price >= 1
                && (int)$offer->kaspi > 0
                && (
                    $offer->in_stock > 0
                    || (
                        (int)$offer->pre_order > 0
                        && (int)$offer->pre_order < 21
                    )
                    // || $offer->alstyle
                )
            ) {
                $kaspi_qty++;

                $product_brand = '';
                foreach ($this->kaspi_brands as $brand) {
                    $pos = strpos('111' . $offer->name, $brand);
                    if ($pos !== false)  $product_brand = $brand;
                }

                dump($kaspi_qty . ' Kaspi: ' . (string)$offer->id . ', ' . $offer->in_stock . ', ' . $offer->halyk . '<br>');

                if (($offer->in_stock == 0) and ((int)$offer->pre_order > 0)) {
                    $xml .= PHP_EOL . '<offer sku="' . (string)$offer->id . '">';
                    $xml .= PHP_EOL . '<model>' . $offer->name . '</model>';
                    $xml .= PHP_EOL . '<brand>' . $product_brand . '</brand>';
                    $xml .= PHP_EOL . '<availabilities>';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" preOrder="' . (int)$offer->pre_order . '" />';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP2" preOrder="' . (int)$offer->pre_order . '" />';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP3" preOrder="' . (int)$offer->pre_order . '" />';
                    $xml .= PHP_EOL . '</availabilities>';
                    $xml .= PHP_EOL . '<price>' . $offer->price . '</price>';
                    $xml .= PHP_EOL . '</offer>';
                } else if (false && $offer->in_stock == 0 && $offer->alstyle != null) {
                    // dump('ID от Вендора: ' . round($offer->alstyle) . ', ');
                    // $dataAlStyle = $this->getAlStyleProduct($offer);
                    // dump('наличиее у Вендера: ' . $dataAlStyle[$offer->alstyle]['quantity'] . ', ');
                    // if ((!empty($dataAlStyle[$offer->alstyle]['price2'])) and (!empty($dataAlStyle[$offer->alstyle]['price1']))) {
                    //     dump('Розница у Вендер: ' . $dataAlStyle[$offer->alstyle]['price2'] . ', Закуп у Вендер: ' . $dataAlStyle[$offer->alstyle]['price1'] . ', Наценка: ' . $dataAlStyle[$offer->alstyle]['price2'] / $dataAlStyle[$offer->alstyle]['price1'] . ', ');
                    // }
                    // if (((str_replace('>', '', $dataAlStyle[$offer->alstyle]['quantity'])) > 3) and (($dataAlStyle[$offer->alstyle]['price2'] / $dataAlStyle[$offer->alstyle]['price1']) > 1.17)) {
                    //     $xml .= PHP_EOL . '<offer sku="' . (string)$offer->id . '">';
                    //     $xml .= PHP_EOL . '<model>' . $offer->name . '</model>';
                    //     $xml .= PHP_EOL . '<brand>' . $product_brand . '</brand>';
                    //     $xml .= PHP_EOL . '<availabilities>';
                    //     $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" preOrder="4" />';
                    //     $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" preOrder="4" />';
                    //     $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" preOrder="4" />';
                    //     $xml .= PHP_EOL . '</availabilities>';
                    //     $xml .= PHP_EOL . '<price>' . $dataAlStyle[$offer->alstyle]['price2'] . '</price>';
                    //     $xml .= PHP_EOL . '</offer>';
                    //     dump('добавили товар от Вендера в Каспи, ');
                    // } else {
                    //     dump('у Вендера в наличии меньше 3 или низкая маржа, ');
                    // }
                } else {
                    $xml .= PHP_EOL . '<offer sku="' . (string)$offer->id . '">';
                    $xml .= PHP_EOL . '<model>' . $offer->name . '</model>';
                    $xml .= PHP_EOL . '<brand>' . $product_brand . '</brand>';
                    $xml .= PHP_EOL . '<availabilities>';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" />';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP2" />';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP3" />';
                    $xml .= PHP_EOL . '</availabilities>';
                    $xml .= PHP_EOL . '<price>' . $offer->price . '</price>';
                    $xml .= PHP_EOL . '</offer>';
                }
            }
        }

        $xml .= PHP_EOL . '</offers>';
        $xml .= PHP_EOL . '</kaspi_catalog>';

        dump('В kaspi.xml выгружено: ' . $kaspi_qty);
        if ($kaspi_qty > 610) Storage::put('kaspi.xml', $xml);
    }

    public function exportKaspiBotXml()
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= PHP_EOL . '<kaspi_catalog date="string" xmlns="kaspiShopping" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="kaspiShopping http://kaspi.kz/kaspishopping.xsd">';
        $xml .= PHP_EOL . '<company>Bonanza Trading Company</company>';
        $xml .= PHP_EOL . '<merchantid>voxm</merchantid>';
        $xml .= PHP_EOL . '<offers>';

        foreach (Offer::where('in_stock', '>', 0)->get() as $offer) {

            if (
                (float)$offer->price >= 1
                && (int)$offer->kaspi > 0
                && (
                    $offer->in_stock > 0
                    || (
                        (int)$offer->pre_order > 0
                        && (int)$offer->pre_order < 21
                    )
                    || $offer->alstyle
                )
            ) {

                $product_brand = '';
                foreach ($this->kaspi_brands as $brand) {
                    $pos = strpos('111' . $offer->name, $brand);
                    if ($pos !== false)  $product_brand = $brand;
                }

                if (($offer->in_stock == 0) and ((int)$offer->pre_order > 0)) {
                    $xml .= PHP_EOL . '<offer sku="' . (string)$offer->id . '">';
                    $xml .= PHP_EOL . '<model>' . $offer->name . '</model>';
                    $xml .= PHP_EOL . '<brand>' . $product_brand . '</brand>';
                    $xml .= PHP_EOL . '<availabilities>';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" preOrder="' . (int)$offer->pre_order . '" />';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP2" preOrder="' . (int)$offer->pre_order . '" />';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP3" preOrder="' . (int)$offer->pre_order . '" />';
                    $xml .= PHP_EOL . '</availabilities>';
                    $xml .= PHP_EOL . '<rrp>' . $offer->rrp . '</rrp>';
                    $xml .= PHP_EOL . '<price>' . $offer->price . '</price>';
                    $xml .= PHP_EOL . '<price_basic>' . $offer->price_old . '</price_basic>';
                    $xml .= PHP_EOL . '<price_min>' . $offer->price . '</price_min>';
                    $xml .= PHP_EOL . '</offer>';
                } else if (false && $offer->in_stock == 0 && $offer->alstyle != null) {
                    // dump('ID от Вендора: ' . round($offer->alstyle) . ', ');
                    // $dataAlStyle = $this->getAlStyleProduct($offer);
                    // dump('наличиее у Вендера: ' . $dataAlStyle[$offer->alstyle]['quantity'] . ', ');
                    // if ((!empty($dataAlStyle[$offer->alstyle]['price2'])) and (!empty($dataAlStyle[$offer->alstyle]['price1']))) {
                    //     dump('Розница у Вендер: ' . $dataAlStyle[$offer->alstyle]['price2'] . ', Закуп у Вендер: ' . $dataAlStyle[$offer->alstyle]['price1'] . ', Наценка: ' . $dataAlStyle[$offer->alstyle]['price2'] / $dataAlStyle[$offer->alstyle]['price1'] . ', ');
                    // }
                    // if (((str_replace('>', '', $dataAlStyle[$offer->alstyle]['quantity'])) > 3) and (($dataAlStyle[$offer->alstyle]['price2'] / $dataAlStyle[$offer->alstyle]['price1']) > 1.17)) {
                    //     $xml .= PHP_EOL . '<offer sku="' . (string)$offer->id . '">';
                    //     $xml .= PHP_EOL . '<model>' . $offer->name . '</model>';
                    //     $xml .= PHP_EOL . '<brand>' . $product_brand . '</brand>';
                    //     $xml .= PHP_EOL . '<availabilities>';
                    //     $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" preOrder="4" />';
                    //     $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" preOrder="4" />';
                    //     $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" preOrder="4" />';
                    //     $xml .= PHP_EOL . '</availabilities>';
                    //     $xml .= PHP_EOL . '<price>' . $dataAlStyle[$offer->alstyle]['price2'] . '</price>';
                    //     $xml .= PHP_EOL . '</offer>';
                    //     dump('добавили товар от Вендера в Каспи, ');
                    // } else {
                    //     dump('у Вендера в наличии меньше 3 или низкая маржа, ');
                    // }
                } else {
                    $xml .= PHP_EOL . '<offer sku="' . (string)$offer->id . '">';
                    $xml .= PHP_EOL . '<model>' . $offer->name . '</model>';
                    $xml .= PHP_EOL . '<brand>' . $product_brand . '</brand>';
                    $xml .= PHP_EOL . '<availabilities>';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP1" />';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP2" />';
                    $xml .= PHP_EOL . '<availability available="yes" storeId="PP3" />';
                    $xml .= PHP_EOL . '</availabilities>';
                    $xml .= PHP_EOL . '<rrp>' . $offer->rrp . '</rrp>';
                    $xml .= PHP_EOL . '<price>' . $offer->price . '</price>';
                    $xml .= PHP_EOL . '<price_basic>' . $offer->price_old . '</price_basic>';
                    $xml .= PHP_EOL . '<price_min>' . $offer->price . '</price_min>';
                    $xml .= PHP_EOL . '</offer>';
                }
            }
        }

        $xml .= PHP_EOL . '</offers>';
        $xml .= PHP_EOL . '</kaspi_catalog>';

        Storage::put('kaspi_bot.xml', $xml);
    }

    public function exportFacebookXml()
    {

        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= PHP_EOL . '<!DOCTYPE yml_catalog SYSTEM "shops.dtd">';
        $xml .= PHP_EOL . '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">';
        $xml .= PHP_EOL . '<channel>';
        $xml .= PHP_EOL . '<title>' . config('app.name') . '</title>';
        $xml .= PHP_EOL . '<link>' . config('app.url') . '</link>';
        $xml .= PHP_EOL . '<description>"Internet Store"</description>';

        foreach (Offer::where('in_stock', '>', 0)->get() as $offer) {

            $url = route('ru.product', [
                'product' => $offer->slug
            ]);

            $product = $offer->product;

            $imagelink = $offer->images()->count() ? $offer->images[0] : ($product && $product->images()->count() ? $product->images[0] : "");

            $xml .= PHP_EOL . '<item>';
            $xml .= PHP_EOL . '<g:id>' . htmlspecialchars($offer->article) . '</g:id>';
            $xml .= PHP_EOL . '<g:title>' . htmlspecialchars(trim(strip_tags($offer->name))) . '</g:title>';
            if ($product && $product->description) {
                $xml .= PHP_EOL . '<g:description>#️⃣ ' . htmlspecialchars(strip_tags($product->description)) . ' ✳️ Модель: ' . htmlspecialchars($offer->article) . ' ❤️ Рассрочка и кредит ⭐ Гарантия 1 год ✴️ Бесплатная доставка ⛪ Адрес: Алматы, пр. Абая 62А. Доставка в Астану 1️⃣ рабочий день. Доставка по Казахстану 3️⃣ рабочих дня в крупные города</g:description>';
            }
            $xml .= PHP_EOL . '<g:link>' . $url . '</g:link>';
            $xml .= PHP_EOL . '<g:image_link>' . urlencode($imagelink) . '</g:image_link>';
            if ($product && $product->brand && $product->brand->name) {
                $xml .= PHP_EOL . '<g:brand>' . htmlspecialchars($product->brand->name) . '</g:brand>';
            }
            $xml .= PHP_EOL . '<g:condition>new</g:condition>';
            $xml .= PHP_EOL . '<g:availability>in stock</g:availability>';
            if ($offer->old_price && $offer->old_price != $offer->price) {
                $xml .= PHP_EOL . '<g:price>' . $offer->old_price . ' KZT</g:price>';
                $xml .= PHP_EOL . '<g:sale_price>' . $offer->price . ' KZT</g:sale_price>';
                $xml .= PHP_EOL . '<g:sale_price_effective_date>' . date(DATE_ATOM, strtotime('yesterday')) . '/' . date(DATE_ATOM, strtotime('tomorrow')) . '</g:sale_price_effective_date>';
            } else {
                $xml .= PHP_EOL . '<g:price>' . $offer->price . ' KZT</g:price>';
            }
            $xml .= PHP_EOL . '<g:shipping>';
            $xml .= PHP_EOL . '<g:country>KZ</g:country>';
            $xml .= PHP_EOL . '<g:service>По Алматы / По Казахстану</g:service>';
            $delivery_cost = "0.0";
            if ($offer->price < 10000) $delivery_cost = "1000.00 KZT";
            $xml .= PHP_EOL . '<g:price>' . $delivery_cost . '</g:price>';
            $xml .= PHP_EOL . '</g:shipping>';
            $xml .= PHP_EOL . '<g:google_product_category>' . ($product && $product->category ? $product->category->id : 0) . '</g:google_product_category>';
            $xml .= PHP_EOL . '<g:custom_label_0>Оригинальный товар</g:custom_label_0>';
            $xml .= PHP_EOL . '</item>';
            dump('facebook - ' . htmlspecialchars(trim(strip_tags($offer->name)))  . ' / РЦ: ' . $offer->price . ' / БЦ: ' . $offer->old_price . '<br>');
        }

        $xml .= PHP_EOL . '</channel>';
        $xml .= PHP_EOL . '</rss>';

        Storage::put('facebook.xml', $xml);
    }

    public function phone($phone)
    {
        $phone = str_replace(" ", "", $phone);
        $phone = str_replace("-", "", $phone);
        $phone = str_replace("(", "", $phone);
        $phone = str_replace(")", "", $phone);
        $phone = str_replace("+", "", $phone);
        $phone = preg_replace('/\D*/', '', $phone);
        if (substr($phone, 0, 1) == 8) $phone[0] = 7;
        return $phone;
    }

    public function notify($message)
    {
        $user = new User();
        $user->email = 'pimax1978@icloud.com';
        $user->notify(new FailSmsNotification($message));
    }

    public function getAlStyleProduct($product)
    {
        dump('ID от Вендора: ' . round($product->alstyle) . ', ');
        $url = "https://api.al-style.kz/api/quantity-price";
        $accessToken = "6cRl1E9nrsPcEY3HVgoEsFo0F87IR4z7";
        $article = $product->alstyle;
        $params = array(
            "access-token" => $accessToken,
            "article" => $article
        );
        $queryString = http_build_query($params);
        $fullUrl = $url . "?" . $queryString;
        $response = file_get_contents($fullUrl);
        return json_decode($response, true);
    }

    public function sendToTelegram()
    {
        $botToken = '6329481892:AAG5-qK7kYZ2BX7Yfpf-1xwaGXOx3Lfw9SM';
        $chatId = '@xiaomimhomekz'; // или chat_id, если это приватный канал

        $productlink = str_replace("kz//", "kz/", JURI::base() . JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id));
        $priceformated = number_format($price, 0, ',', ' ');

        $message = "🟢 Новое поступление 🟢\n\n*$name*\n\nЦена: $priceformated ₸\n\n$productlink\n\n";

        $apiUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message) . "&parse_mode=Markdown";

        $response = file_get_contents($apiUrl);
        $responseArray = json_decode($response, true);

        if ($responseArray && $responseArray['ok']) {
            echo 'Сообщение в Телеграм успешно отправлено.';
        } else {
            echo 'Произошла ошибка при отправке Телеграм сообщения.';
        }
    }
}
