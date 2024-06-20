<?php

namespace App\Console\Commands;

use App\Services\TgBot;
use Illuminate\Console\Command;

class SendTgMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-tg-message';

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
        $tg = new TgBot();
        $tg->sendMessage('test');
    }
}
