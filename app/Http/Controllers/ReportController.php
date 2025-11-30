<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function loans(Request $request)
    {
        $query = Loan::with(['book', 'member.user']);

        // Date range filter
        if ($request->filled('start_date')) {
            $query->where('loan_date', '>=', Carbon::parse($request->start_date));
        }
        if ($request->filled('end_date')) {
            $query->where('loan_date', '<=', Carbon::parse($request->end_date));
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status == 'overdue') {
                $query->where('status', 'approved')->where('due_date', '<', now());
            } else {
                $query->where('status', $request->status);
            }
        }

        $loans = $query->latest()->paginate(15)->withQueryString();

        // Statistics
        $totalLoans = $query->count();
        $returnedLoans = (clone $query)->where('status', 'returned')->count();
        $activeLoans = (clone $query)->where('status', 'approved')->count();
        $overdueLoans = (clone $query)->where('status', 'approved')->where('due_date', '<', now())->count();

        // Chart Data
        $chartData = [
            'returned' => $returnedLoans,
            'active' => $activeLoans,
            'overdue' => $overdueLoans,
            'monthly' => $this->getMonthlyLoanData($query),
        ];

        // Prepare Excel data
        $excelData = [
            ['ID Peminjaman', 'ID Anggota', 'Nama Anggota', 'Email Anggota', 'ISBN Buku', 'Judul Buku', 'Kategori Buku', 'Pengarang', 'Penerbit', 'Tahun Terbit', 'Tanggal Pinjam', 'Tanggal Harus Kembali', 'Tanggal Dikembalikan', 'Durasi Pinjam (hari)', 'Status', 'Denda', 'Petugas', 'Catatan']
        ];

        foreach ($loans as $loan) {
            $excelData[] = [
                $loan->loan_code ?? 'L-' . date('Y') . '-' . str_pad($loan->id, 3, '0', STR_PAD_LEFT),
                $loan->member->member_code ?? 'N/A',
                $loan->member->name ?? 'N/A',
                $loan->member->user->email ?? 'N/A',
                $loan->book->isbn ?? 'N/A',
                $loan->book->title ?? 'N/A',
                $loan->book->category->name ?? 'N/A',
                $loan->book->author ?? 'N/A',
                $loan->book->publisher ?? 'N/A',
                $loan->book->year ?? 'N/A',
                $loan->loan_date ? $loan->loan_date->format('d/m/Y') : 'N/A',
                $loan->due_date ? $loan->due_date->format('d/m/Y') : 'N/A',
                $loan->return_date ? $loan->return_date->format('d/m/Y') : 'N/A',
                $loan->loan_date && $loan->return_date ? $loan->loan_date->diffInDays($loan->return_date) : ($loan->loan_date && $loan->due_date ? $loan->loan_date->diffInDays($loan->due_date) : 'N/A'),
                $loan->status == 'returned' ? 'Dikembalikan' : ($loan->status == 'active' ? 'Aktif' : ($loan->status == 'overdue' ? 'Terlambat' : ucfirst($loan->status ?? 'N/A'))),
                $loan->fine_amount ?? 0,
                $loan->approved_by ?? 'N/A',
                $loan->notes ?? ''
            ];
        }

        // Prepare loan items for PDF export
        $loanItems = $loans->items();

        // Prepare info data for Excel export
        $infoData = [
            ['PERPUSTAKAAN AZFAKUN'],
            ['Jl. Aladin, No. 777, Kota Atlantis'],
            ['Telp: (021) 12345678 | Email: info@azfakun.library.id'],
            [''],
            ['LAPORAN PEMINJAMAN BUKU'],
            ['Tanggal: ' . now()->format('d F Y')],
            [''],
            ['RINGKASAN STATISTIK'],
            ['Total Peminjaman', $totalLoans],
            ['Dikembalikan', $returnedLoans],
            ['Aktif', $activeLoans],
            ['Terlambat', $overdueLoans],
            [''],
            ['DETAIL PEMINJAMAN']
        ];

        return view('LaporanPeminjaman', compact(
            'loans',
            'totalLoans',
            'returnedLoans',
            'activeLoans',
            'overdueLoans',
            'chartData',
            'excelData',
            'loanItems',
            'infoData'
        ));
    }

    private function getMonthlyLoanData($query)
    {
        $monthlyData = array_fill(0, 12, 0);
        $results = (clone $query)
            ->selectRaw('MONTH(loan_date) as month, COUNT(*) as count')
            ->whereYear('loan_date', now()->year)
            ->groupBy('month')
            ->get();

        foreach ($results as $result) {
            $monthlyData[$result->month - 1] = $result->count;
        }

        return $monthlyData;
    }
}
