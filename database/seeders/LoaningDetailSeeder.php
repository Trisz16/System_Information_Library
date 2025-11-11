<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoaningDetail;

class LoaningDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loaningDetails = [
            [
                'id_peminjaman' => 1,
                'id_buku' => 1,
                'jumlah_peminjaman' => 1,
                'denda' => 0.00,
                'catatan' => 'Buku dalam kondisi baik',
            ],
            [
                'id_peminjaman' => 2,
                'id_buku' => 2,
                'jumlah_peminjaman' => 1,
                'denda' => 0.00,
                'catatan' => 'Pengembalian tepat waktu',
            ],
            [
                'id_peminjaman' => 3,
                'id_buku' => 3,
                'jumlah_peminjaman' => 1,
                'denda' => 5000.00, // denda untuk keterlambatan
                'catatan' => 'Terlambat 1 hari, denda Rp 5.000',
            ],
            [
                'id_peminjaman' => 4,
                'id_buku' => 4,
                'jumlah_peminjaman' => 1,
                'denda' => 0.00,
                'catatan' => 'Peminjaman staff',
            ],
            [
                'id_peminjaman' => 5,
                'id_buku' => 5,
                'jumlah_peminjaman' => 1,
                'denda' => 0.00,
                'catatan' => 'Pengembalian dalam kondisi baik',
            ],
        ];

        foreach ($loaningDetails as $detail) {
            \App\Models\LoaningDetail::create($detail);
        }
    }
}
