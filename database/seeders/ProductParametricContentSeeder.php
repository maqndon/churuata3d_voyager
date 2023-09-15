<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductParametricContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = "This model is also available in parametric format. This means that the model can be modified according to your specific needs. You just need to have the Openscad program installed, which is Free Software, and change certain values in the 'measurements_inc.scad' file. These files are only availables for our monthly supporters from <a title='Buy me a Coffee' href='https://www.buymeacoffee.com/ZVSrxgH' target='_blank' rel='nofollow noopener noreferrer'>www.buymeacoffee.com</a>";

        // Insert the content into the product_parametric_content table
        DB::table('product_parametric_content')->insert([
            'content' => $content,
        ]);
    }
}
