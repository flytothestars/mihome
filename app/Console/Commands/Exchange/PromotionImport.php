<?php

namespace App\Console\Commands\Exchange;

use App\Models\Promotion;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PromotionImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:promotion-import';

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
        foreach (DB::table('joom_content')
            ->where('catid', 14)
            ->select(['*'])
            ->get() as $data) {
            $promotion = new Promotion();
            $promotion->title = $data->title;
            $promotion->order = $data->ordering;

            $promotion->text = $data->introtext;
            $promotion->active_from = $data->publish_up;
            $promotion->active_to = $data->publish_down;

            $images = json_decode($data->images);
            $img = explode('#', $images->image_intro)[0];
            $promotion->image = $img ? ('/' . $img) : '';

            $urls = json_decode($data->urls);
            $promotion->link = str_replace('https://mi-home.kz', '', $urls->urla);

            $promotion->save();
        }
    }
}
