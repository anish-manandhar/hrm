<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    protected $settings = [
        [
            'key' => 'organization_name',
            'value' => 'Human Resource Management System',
        ],
        [
            'key' => 'organization_short_name',
            'value' => 'HRM',
        ],
        [
            'key' => 'organization_logo',
            'value' => '/static/new_logo.png',
        ],
        [
            'key' => 'slogan',
            'value' => 'Everything you believe is possible!',
        ],
        [
            'key' => 'detail_address',
            'value' => 'Near Buckingham Palace',
        ],
        [
            'key' => 'country',
            'value' => 'Nepal',
        ],
        [
            'key' => 'primary_phone',
            'value' => '1234567890',
        ],
        [
            'key' => 'secondary_phone',
            'value' => '0987654321',
        ],
        [
            'key' => 'employee_prefix',
            'value' => 'UTS-',
        ],
        [
            'key' => 'weekly_holiday',
            'value' => null,
        ],
        [
            'key' => 'division_enabled',
            'value' => 1,
        ],
        [
            'key' => 'days_in_month_for_salary',
            'value' => 30,
        ],
        [
            'key' => 'default_country',
            'value' => 151,
        ],
        [
            'key' => 'sms_identity',
            'value' => 'InfoAlert',
        ],
        [
            'key' => 'sms_token',
            'value' => 'v2_vFi6rEp1n7wZ972ysUtzzP6RDun.cHnQ',
        ],
        [
            'key' => 'sms_api',
            'value' => 'http://api.sparrowsms.com/v2/sms/',
        ],
    ];

    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted ' . count($this->settings) . ' records');
    }
}
