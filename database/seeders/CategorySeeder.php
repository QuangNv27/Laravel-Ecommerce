<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Áo sơ mi',
            'slug' => 'ao-so-mi',
        ]);

        Category::create([
            'name' => 'Quần jeans',
            'slug' => 'quan-jeans',
        ]);

        Category::create([
            'name' => 'Áo khoác',
            'slug' => 'ao-khoac',
        ]);

        Category::create([
            'name' => 'Giày thể thao',
            'slug' => 'giay-the-thao',
        ]);
    }
}
