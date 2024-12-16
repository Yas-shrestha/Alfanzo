<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\SiteConfig;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siteConfigs = [
            [
                'siteKey' => 'Banner',
                'siteValue' => '',
            ],

            [
                'siteKey' => 'Instagram',
                'siteValue' => 'https://www.instagram.com/alfanzooresort/',
            ],
            [
                'siteKey' => 'Facebook',
                'siteValue' => 'https://www.facebook.com/AlfanzooResort/',
            ],
            [
                'siteKey' => 'Youtube',
                'siteValue' => 'https://www.Youtube.com',
            ],
            [
                'siteKey' => 'Email',
                'siteValue' => 'alfanzooresortpokhara@gmail.com',
            ],
            [
                'siteKey' => 'Twitter',
                'siteValue' => 'https://www.twitter.com',
            ],
            [
                'siteKey' => 'Phone',
                'siteValue' => '9804172730',
            ],
            [
                'siteKey' => 'Location',
                'siteValue' => 'Pokhara',
            ],
            [
                'siteKey' => 'Logo',
                'siteValue' => 'Alfanzoo.png',
            ],
            [
                'siteKey' => 'ResturantName',
                'siteValue' => 'Alfanzoo',
            ],
            [
                'siteKey' => 'BookinVideo',
                'siteValue' => 'https://www.youtube.com/embed/FhwqbF9zwUo?si=jZmqZzG_NPbx_2c9',
            ],
            [
                'siteKey' => 'FooterDescription',
                'siteValue' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, perferendis.
                ',
            ],
        ];

        SiteConfig::insert($siteConfigs);
    }
}
