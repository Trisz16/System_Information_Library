<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loans = [
            [
                'id_anggota' => 3, // mahasiswa user
                'id_buku' => 1, // Laravel for Beginners
                'tanggal_peminjaman' => Carbon::now()->subDays(5),
                'tanggal_pengembalian' => null,
                'tanggal_jatuh_tempo' => Carbon::now()->addDays(7),
                'status' => 'dipinjam',
                'catatan' => 'Peminjaman untuk tugas akhir',
            ],
            [
                'id_anggota' => 3, // mahasiswa user
                'id_buku' => 2, // PHP Advanced Techniques
                'tanggal_peminjaman' => Carbon::now()->subDays(10),
                'tanggal_pengembalian' => Carbon::now()->subDays(2),
                'tanggal_jatuh_tempo' => Carbon::now()->subDays(3),
                'status' => 'dikembalikan',
                'catatan' => 'Dikembalikan tepat waktu',
            ],
            [
                'id_anggota' => 3, // mahasiswa user
                'id_buku' => 3, // JavaScript Fundamentals
                'tanggal_peminjaman' => Carbon::now()->subDays(15),
                'tanggal_pengembalian' => null,
                'tanggal_jatuh_tempo' => Carbon::now()->subDays(1),
                'status' => 'terlambat',
                'catatan' => 'Terlambat pengembalian',
            ],
            [
                'id_anggota' => 2, // staff user
                'id_buku' => 4, // The Great Adventure
                'tanggal_peminjaman' => Carbon::now()->subDays(3),
                'tanggal_pengembalian' => null,
                'tanggal_jatuh_tempo' => Carbon::now()->addDays(9),
                'status' => 'dipinjam',
                'catatan' => 'Peminjaman untuk koleksi pribadi',
            ],
            [
                'id_anggota' => 2, // staff user
                'id_buku' => 5, // Mystery of the Lost City
                'tanggal_peminjaman' => Carbon::now()->subDays(7),
                'tanggal_pengembalian' => Carbon::now()->subDays(1),
                'tanggal_jatuh_tempo' => Carbon::now()->addDays(5),
                'status' => 'dikembalikan',
                'catatan' => 'Dikembalikan dalam kondisi baik',
            ],
        ];

        foreach ($loans as $loan) {
            Loan::create($loan);
        }
    }
}
