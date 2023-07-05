<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bank = array(
            0 =>
            array(
                'name' => 'BANK BRI',
                'code' => '002',
            ),
            1 =>
            array(
                'name' => 'BANK BNI',
                'code' => '009',
            ),
            2 =>
            array(
                'name' => 'BANK BCA',
                'code' => '014',
            ),
        );

        collect($bank)->map(function($item) {
            Bank::query()
                ->updateOrCreate(
                    ['code' => $item['code']],
                    [
                        'code' => $item['code'],
                        'name' => $item['name'],
                    ],
                );
        });
    }
}
