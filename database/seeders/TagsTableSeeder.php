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
            ['name'=>'home', 'slug'=>'home'],
            ['name'=>'office', 'slug'=>'office'],
            ['name'=>'kitchen', 'slug'=>'kitchen'],
            ['name'=>'bad', 'slug'=>'bad'],
        ];

        foreach ($tags as $tag) {
            \App\Models\Tag::firstOrNew()->create([
              'name' => $tag['name'],
              'slug' => $tag['slug'],
          ]);
        }
    }
}
