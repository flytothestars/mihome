<?php

namespace App\Console\Commands;

use App\Models\PropertyValue;
use App\Observers\PropertyValueObserver;
use Illuminate\Console\Command;

class ObserevPropertyValues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:obserev-property-values';

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
        foreach (PropertyValue::all() as $value) {
            (new PropertyValueObserver())->creating($value);
            $value->saveQuietly();
        }
    }
}
