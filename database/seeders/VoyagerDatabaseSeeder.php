<?php

namespace Database\Seeders;

use App\Models\PrintingMaterial;
use App\Models\PrintSetting;
use Illuminate\Database\Seeder;

class VoyagerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DataTypesTableSeeder::class,
            DataRowsTableSeeder::class,
            MenusTableSeeder::class,
            MenuItemsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
            SettingsTableSeeder::class,
            ProductsBreadSeeder::class,
            PostsBreadSeeder::class,
            PagesBreadSeeder::class,
            CategoriesBreadSeeder::class,
        ]);
    }
}
