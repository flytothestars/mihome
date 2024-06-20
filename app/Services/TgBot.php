<?php

namespace App\Services;

use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class TgBot
{

    private $apikey;
    private $username;
    private $telegram;
    private $hook_url;

    public function __construct()
    {
        $this->apikey = config('tg.apikey');
        $this->username = config('tg.username');
        $this->hook_url = config('tg.hook_url');
        $this->telegram = new Telegram($this->apikey, $this->username);
    }

    public function sendMessage($message)
    {
        $request = new Request();
        $request->initialize($this->telegram);
        // $result = $this->telegram->getCommandsList();
        $result = $request->sendMessage([
            'chat_id' => '@testmaxb',
            'text'    => $message,
        ]);
        dump($result);
    }
}
