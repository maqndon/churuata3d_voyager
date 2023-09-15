<?php

namespace Database\Seeders;

use App\Models\Licence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChuruataDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TagsTableSeeder::class,
            PrintingMaterialSeeder::class,
            PrintSettingSeeder::class,
            LicenceSeeder::class,
            ProductParametricContentSeeder::class,
        ]);
    }
}
