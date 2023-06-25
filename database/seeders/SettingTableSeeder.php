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
            'email' => 'support@sekawan.com',
            'owner_name' => 'Kuswandi',
            'company_name' => 'PT. Sekawan',
            'short_description' => '-',
            'keyword' => 'sosial',
            'phone' => '081298694640',
            'postal_code' => '16820',
            'city' => 'Bogor',
            'province' => 'Jawa Barat',
        ]);
    }
}
