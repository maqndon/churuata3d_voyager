<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            "home",
            "office",
            "kitchen",
            "bad",
        ];

        foreach ($tags as $tag) {
            \App\Models\Tag::firstOrNew()->create([
              'name' => $tag,
          ]);
        }
    }
}
