<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Programming'],
            ['nama_kategori' => 'Fiction'],
            ['nama_kategori' => 'Science'],
            ['nama_kategori' => 'History'],
            ['nama_kategori' => 'Biography'],
            ['nama_kategori' => 'Mathematics'],
            ['nama_kategori' => 'Literature'],
            ['nama_kategori' => 'Technology'],
            ['nama_kategori' => 'Philosophy'],
            ['nama_kategori' => 'Art & Design'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
