<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = array(
            0 => array('name' => 'Bencana Alam'),
            1 => array('name' => 'Balita & Anak Sakit'),
            2 => array('name' => 'Bantuan Medis & Kesehatan'),
            3 => array('name' => 'Bantuan Pendidikan'),
            4 => array('name' => 'Lingkungan'),
            5 => array('name' => 'Kegiatan Sosial'),
            6 => array('name' => 'Infrastruktur Umum'),
            7 => array('name' => 'Karya Kreatif & Modal Usaha'),
            8 => array('name' => 'Menolong Hewan'),
            9 => array('name' => 'Rumah Ibadah'),
            10 => array('name' => 'Difabel'),
            11 => array('name' => 'Zakat'),
            12 => array('name' => 'Panti Asuhan'),
            13 => array('name' => 'Kemanusiaan'),
            14 => array('name' => 'Wakaf'),
        );

        collect($category)->map(function ($item) {
            Category::query()
                ->updateOrCreate(
                    [
                        'name' => $item['name'],
                        'slug' => Str::slug($item['name']),
                    ],
                );
        });
    }
}
