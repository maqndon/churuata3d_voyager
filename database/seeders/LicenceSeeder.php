<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LicenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licences = [
            [
                'name' => 'by',
                'description' => 'These Model is under the <a href="https://creativecommons.org/licenses/by/4.0/">Attribution 4.0 International (CC BY 4.0)</a> licence.',
                'link' => 'https://creativecommons.org/licenses/by/4.0/',
                'icon' => 'https://licensebuttons.net/l/by/3.0/88x15.png',
                'logo' => 'https://licensebuttons.net/l/by/3.0/88x31.png'
            ],
            [
                'name' => 'by-sa',
                'description' => 'These Model is under the <a href="https://creativecommons.org/licenses/by-sa/4.0/">Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)</a> licence.',
                'link' => 'https://creativecommons.org/licenses/by-sa/4.0/',
                'icon' => 'https://licensebuttons.net/l/by-sa/3.0/88x15.png',
                'logo' => 'https://licensebuttons.net/l/by-sa/3.0/88x31.png'
            ],
            [
                'name' => 'by-nd',
                'description' => 'These Model is under the <a href="https://creativecommons.org/licenses/by-nd/4.0/">Attribution-NoDerivatives 4.0 International (CC BY-ND 4.0)</a> licence.',
                'link' => 'https://creativecommons.org/licenses/by-nd/4.0/',
                'icon' => 'https://licensebuttons.net/l/by-nd/3.0/88x15.png',
                'logo' => 'https://licensebuttons.net/l/by-nd/3.0/88x31.png'
            ],
            [
                'name' => 'by-nc',
                'description' => 'These Model is under the <a href="https://creativecommons.org/licenses/by-nc/4.0/">Attribution-NonCommercial 4.0 International (CC BY-NC 4.0)</a> licence.',
                'link' => 'https://creativecommons.org/licenses/by-nc/4.0/',
                'icon' => 'https://licensebuttons.net/l/by-nc/3.0/88x15.png',
                'logo' => 'https://licensebuttons.net/l/by-nc/3.0/88x31.png'
            ],
            [
                'name' => 'by-nc-sa',
                'description' => 'These Model is under the <a href="https://creativecommons.org/licenses/by-nc/4.0/">Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)</a> licence.',
                'link' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
                'icon' => 'https://licensebuttons.net/l/by-nc-sa/3.0/88x15.png',
                'logo' => 'https://licensebuttons.net/l/by-nc-sa/3.0/88x31.png'
            ],
            [
                'name' => 'by-nc-nd',
                'description' => 'These Model is under the <a href="https://creativecommons.org/licenses/by-nc/4.0/">Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0) </a> licence.',
                'link' => 'https://creativecommons.org/licenses/by-nc-nd/4.0/',
                'icon' => 'https://licensebuttons.net/l/by-nc-nd/3.0/88x15.png',
                'logo' => 'https://licensebuttons.net/l/by-nc-nd/3.0/88x31.png'
            ],
        ];

        foreach ($licences as $licence) {
            \App\Models\Licence::firstOrNew()->create([
                'name' => $licence['name'],
                'description' => $licence['description'],
                'link' => $licence['link'],
                'icon' => $licence['icon'],
                'logo' => $licence['logo'],
            ]);
        }
    }
}
