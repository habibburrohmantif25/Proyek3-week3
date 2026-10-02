<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Workshop', 'slug' => 'workshop'],
            ['name' => 'Seminar', 'slug' => 'seminar'],
            ['name' => 'Kompetisi', 'slug' => 'kompetisi'],
            ['name' => 'Kategori Kosong', 'slug' => 'kategori-kosong'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
