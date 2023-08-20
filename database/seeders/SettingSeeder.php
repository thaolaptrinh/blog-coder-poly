<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $settingsInitial = [
            [
                'key' => 'site_name',
                'value' => config('app.name')
            ],
            [
                'key' => 'site_status',
                'value' => \App\Enums\BlogStatus::ACTIVE->value,
            ],
            [
                'key' => 'site_description',
                'value' => config('app.name')
            ],

            [
                'key' => 'site_keywords',
                'value' => config('app.name')
            ],

            [
                'key' => 'url_facebook',
                'value' => 'https://www.facebook.com'
            ],

            [
                'key' => 'url_youtube',
                'value' => 'https://youtube.com'
            ],

            [
                'key' => 'url_twitter',
                'value' => 'https://twitter.com'
            ],

            [
                'key' => 'url_instagram',
                'value' => 'https://instagram.com'
            ],

            [
                'key' => 'logo',
                'value' => 'https://coderpoly.com/wp-content/uploads/2022/09/logo-1.png'
            ],

            [
                'key' => 'favicon',
                'value' => 'https://coderpoly.com/wp-content/uploads/2022/09/logo-1.png'
            ],
        ];

        foreach ($settingsInitial as $setting) {
            Setting::create($setting);
        }
    }
}
