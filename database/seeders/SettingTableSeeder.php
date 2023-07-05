<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'email' => 'support@sko.com',
            'owner_name' => 'Mr. Kuswandi',
            'company_name' => 'PT. SKO',
            'short_description' => '-',
            'keyword' => 'sosial',
            'phone' => '081298694640',
            'postal_code' => '16820',
            'city' => 'Bogor',
            'province' => 'Jawa Barat',
            'work_hours' => 'Senin - Jum\'at, 08:00 s/d 17:00',
        ]);
    }
}
