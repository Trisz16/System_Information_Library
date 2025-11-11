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
            // Programming books
            [
                'judul' => 'Laravel for Beginners',
                'penulis' => 'John Doe',
                'penerbit' => 'Tech Publisher',
                'tahun_terbit' => 2023,
                'stok' => 15,
                'id_kategori' => 1,
            ],
            [
                'judul' => 'PHP Advanced Techniques',
                'penulis' => 'Jane Smith',
                'penerbit' => 'Code Books Inc',
                'tahun_terbit' => 2022,
                'stok' => 10,
                'id_kategori' => 1,
            ],
            [
                'judul' => 'JavaScript Fundamentals',
                'penulis' => 'Mike Johnson',
                'penerbit' => 'Web Dev Press',
                'tahun_terbit' => 2021,
                'stok' => 20,
                'id_kategori' => 1,
            ],

            // Fiction books
            [
                'judul' => 'The Great Adventure',
                'penulis' => 'Sarah Wilson',
                'penerbit' => 'Fiction House',
                'tahun_terbit' => 2020,
                'stok' => 12,
                'id_kategori' => 2,
            ],
            [
                'judul' => 'Mystery of the Lost City',
                'penulis' => 'Robert Brown',
                'penerbit' => 'Mystery Books',
                'tahun_terbit' => 2019,
                'stok' => 8,
                'id_kategori' => 2,
            ],

            // Science books
            [
                'judul' => 'Introduction to Physics',
                'penulis' => 'Dr. Albert Einstein Jr.',
                'penerbit' => 'Science Publications',
                'tahun_terbit' => 2023,
                'stok' => 25,
                'id_kategori' => 3,
            ],
            [
                'judul' => 'Chemistry Basics',
                'penulis' => 'Dr. Marie Curie',
                'penerbit' => 'Chemical Press',
                'tahun_terbit' => 2022,
                'stok' => 18,
                'id_kategori' => 3,
            ],

            // History books
            [
                'judul' => 'World War II History',
                'penulis' => 'Prof. History Expert',
                'penerbit' => 'Historical Books',
                'tahun_terbit' => 2021,
                'stok' => 14,
                'id_kategori' => 4,
            ],

            // Biography books
            [
                'judul' => 'Steve Jobs: A Biography',
                'penulis' => 'Walter Isaacson',
                'penerbit' => 'Biography Press',
                'tahun_terbit' => 2011,
                'stok' => 9,
                'id_kategori' => 5,
            ],

            // Mathematics books
            [
                'judul' => 'Calculus Made Easy',
                'penulis' => 'Silvanus P. Thompson',
                'penerbit' => 'Math Publishers',
                'tahun_terbit' => 1910,
                'stok' => 11,
                'id_kategori' => 6,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
