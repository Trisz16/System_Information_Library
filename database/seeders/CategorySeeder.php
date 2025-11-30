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
            ['name' => 'Fiction', 'description' => 'Fictional stories and novels'],
            ['name' => 'Non-Fiction', 'description' => 'Educational and informative books'],
            ['name' => 'Science', 'description' => 'Books about science and technology'],
            ['name' => 'History', 'description' => 'Historical books and biographies'],
            ['name' => 'Biography', 'description' => 'Life stories of notable people'],
            ['name' => 'Technology', 'description' => 'Books about computers and programming'],
            ['name' => 'Literature', 'description' => 'Classic and modern literature'],
            ['name' => 'Education', 'description' => 'Educational materials and textbooks'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
