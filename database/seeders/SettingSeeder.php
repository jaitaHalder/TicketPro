<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                "setting_name" => "SETTING_SITE_TITLE",
                "value" => "Website Title",
            ],
            [
                "setting_name" => "SETTING_SITE_DESCRIPTION",
                "value" => "",
            ],
            [
                "setting_name" => "SETTING_SITE_LOGO",
                "value" => "logo.png",
            ],
            [
                "setting_name" => "SETTING_SITE_FAVICON",
                "value" => "favicon.png",
            ],
            [
                "setting_name" => "SETTING_SOCIAL_FACEBOOK",
                "value" => "#",
            ],
            [
                "setting_name" => "SETTING_SOCIAL_YOUTUBE",
                "value" => "#",
            ],
            [
                "setting_name" => "SETTING_SOCIAL_INSTAGRAM",
                "value" => "#",
            ],
            [
                "setting_name" => "SETTING_SOCIAL_LINKEDIN",
                "value" => "#",
            ],
            [
                "setting_name" => "SETTING_SOCIAL_TWITTER",
                "value" => "#",
            ],
            [
                "setting_name" => "CONTACT_EMAIL",
                "value" => "",
            ],
            [
                "setting_name" => "CONTACT_PHONE",
                "value" => "",
            ],
            [
                "setting_name" => "CONTACT_ADDRESS",
                "value" => "",
            ],
            [
                "setting_name" => "CONTACT_GOOGLE_MAP",
                "value" => "",
            ],
            [
                "setting_name" => "SETTING_ABOUT_US",
                "value" => "",
            ],
            [
                "setting_name" => "PRIVACY_POLICY",
                "value" => "",
            ],
        ];

        Setting::query()->insert($settings);
    }
}
