<?php

namespace Database\Seeders;

use TCG\Voyager\Models\Menu;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class VoyagerShopDatabaseSeeder extends Seeder
{
    /**
     * Run the voyager menus package database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VoyagerShopPermissionsSeeder::class);
        $this->call(VoyagerShopDataTypesSeeder::class);
        $this->call(VoyagerShopDataRowsSeeder::class);
        $this->call(VoyagerShopMenuItemsSeeder::class);
    }
}
