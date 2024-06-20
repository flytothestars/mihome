<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class VoyagerShopInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voyager-shop:install {--force : Whether the assets should be forcefully published or not.} {--demo : Whether the demo content should be added or not.} {--refresh : Whether the whole project should be refreshed.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Voyager Shop Package.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // check if we are in producton
        if (config('app.env') == 'production') {
            // if so, print error message
            $this->error('You are in production mode!');
            // terminate command with error state (>0)
            return 1;
        }

        // install voyager
        $this->installVoyager();

        // provision the packages
        $this->provisionPackages();

        // install cashier
        $this->call('vendor:publish', [
            '--tag' => 'cashier-migrations'
        ]);

        // run migrations
        $this->runMigrations();

        // run seeders
        $this->runSeeders();

        // install demo content
        $this->demo();

        // clear cache
        $this->call('cache:clear');
    }

    /**
     * Install the voyager admin panel.
     *
     * @return void
     */
    private function installVoyager(): void
    {
        $this->call('voyager:install');
    }

    /**
     * Provision the packages.
     *
     * @return void
     */
    private function provisionPackages(): void
    {
        // shop
        $this->call('vendor:publish', [
            '--provider' => "App\Providers\VoyagerShopServiceProvider",
            '--tag' => 'config',
            '--force' => $this->option('force'),
        ]);
        $this->call('vendor:publish', [
            '--provider' => "App\Providers\VoyagerShopServiceProvider",
            '--tag' => 'views',
            '--force' => $this->option('force'),
        ]);
        $this->call('vendor:publish', [
            '--provider' => "App\Providers\VoyagerShopServiceProvider",
            '--tag' => 'lang',
            '--force' => $this->option('force'),
        ]);
        $this->call('vendor:publish', [
            '--provider' => "App\Providers\VoyagerShopServiceProvider",
            '--tag' => 'graphql',
            '--force' => $this->option('force'),
        ]);
        $this->call('vendor:publish', [
            '--provider' => "App\Providers\VoyagerShopServiceProvider",
            '--tag' => 'views',
            '--force' => $this->option('force'),
        ]);
        $this->call('vendor:publish', [
            '--provider' => "App\Providers\VoyagerShopServiceProvider",
            '--tag' => 'middleware',
            '--force' => $this->option('force'),
        ]);

        if (!count(File::glob("database/migrations/*create_webhook_calls_table.php"))) {
            $this->call('vendor:publish', ['--provider' => "Spatie\WebhookClient\WebhookClientServiceProvider", '--tag' => "migrations"]);
        }
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    private function runMigrations(): void
    {
        // get refresh value
        $refresh = $this->option('refresh');

        // if refresh flag is set we want to refresh the migrations
        if ($refresh) {
            $this->call('migrate:refresh');
            return;
        }

        // otherwise we run normal migrations
        $this->call('migrate');
    }

    /**
     * Run the seeders.
     *
     * @return void
     */
    private function runSeeders(): void
    {
        // voyager
        $this->call('db:seed', ['--class' => "VoyagerDatabaseSeeder"]);

        // shop
        $this->call('db:seed', ['--class' => "Database\Seeders\VoyagerShopDatabaseSeeder"]);
    }

    /**
     * Method to add demo content.
     *
     * @return void
     */
    private function demo(): void
    {
        // check if we should install demo content
        if ($this->option('demo')) {
            // run demo content seeder
            $this->call('db:seed', ['--class' => "Database\Seeders\VoyagerShopDemoContentSeeder"]);
        }
    }
}
