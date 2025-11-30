<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laravel for Beginners',
                'author' => 'John Doe',
                'isbn' => '978-1234567890',
                'category_id' => 6, // Technology
                'publisher' => 'Tech Books Inc.',
                'publication_year' => 2023,
                'stock' => 5,
                'description' => 'A comprehensive guide to learning Laravel framework.',
            ],
            [
                'title' => 'The Art of Programming',
                'author' => 'Jane Smith',
                'isbn' => '978-0987654321',
                'category_id' => 6, // Technology
                'publisher' => 'Code Publishers',
                'publication_year' => 2022,
                'stock' => 3,
                'description' => 'Master the fundamentals of programming.',
            ],
            [
                'title' => 'World History: Ancient Civilizations',
                'author' => 'Dr. Robert Johnson',
                'isbn' => '978-1122334455',
                'category_id' => 4, // History
                'publisher' => 'Academic Press',
                'publication_year' => 2021,
                'stock' => 2,
                'description' => 'Explore the rich history of ancient civilizations.',
            ],
            [
                'title' => 'Steve Jobs: A Biography',
                'author' => 'Walter Isaacson',
                'isbn' => '978-1451648539',
                'category_id' => 5, // Biography
                'publisher' => 'Simon & Schuster',
                'publication_year' => 2011,
                'stock' => 4,
                'description' => 'The definitive biography of Steve Jobs.',
            ],
            [
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'isbn' => '978-0262033848',
                'category_id' => 6, // Technology
                'publisher' => 'MIT Press',
                'publication_year' => 2009,
                'stock' => 1,
                'description' => 'Comprehensive textbook on algorithms.',
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '978-0743273565',
                'category_id' => 1, // Fiction
                'publisher' => 'Scribner',
                'publication_year' => 1925,
                'stock' => 6,
                'description' => 'A classic American novel set in the Jazz Age.',
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'isbn' => '978-0062316097',
                'category_id' => 2, // Non-Fiction
                'publisher' => 'Harper',
                'publication_year' => 2014,
                'stock' => 3,
                'description' => 'A sweeping narrative of human history.',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '978-0132350884',
                'category_id' => 6, // Technology
                'publisher' => 'Prentice Hall',
                'publication_year' => 2008,
                'stock' => 2,
                'description' => 'A handbook of agile software craftsmanship.',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
