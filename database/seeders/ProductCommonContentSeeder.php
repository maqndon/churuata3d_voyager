<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCommonContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            ['type' => 'parametric', 'content' => 'This model is also available in parametric format. This means that the model can be modified according to your specific needs. You just need to have the Openscad program installed, which is Free Software, and change certain values in the "measurements_inc.scad" file. These files are only availables for our monthly supporters from <a title="Buy me a Coffee" href="https://www.buymeacoffee.com/ZVSrxgH" target="_blank" rel="nofollow noopener noreferrer">www.buymeacoffee.com</a>'],
            ['type' => 'donation', 'content' => 'If you like our 3D Models please consider making a <a href="https://www.paypal.com/donate/?token=yoph83Med4XEDhKe4SKEpWgED0GXucuzi8z-vy47S7L9c1hKI36pdfP6x7xiyKHZuESyUG&amp;country.x=US&amp;locale.x=US">donation</a>. Thanks!'],
            ['type' => 'comercial_use', 'content' => 'Do you want to use our design for commercial purposes or adapt our models to your specific needs? Simply write us at <a href="info@churuata3d.com">info at churuata3d.com</a>.'],
            ['type' => 'thanks', 'content' => 'We wish you a Happy printing! Enjoy it!']
        ];

        // Insert the content into the product_parametric_content table
        foreach ($contents as $content) {
            DB::table('product_common_content')->insert([
                'type' => $content['type'],
                'content' => $content['content'],
            ]);
        }
    }
}
