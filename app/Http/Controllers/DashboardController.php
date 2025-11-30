<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $stats = [];

        if ($user->isAdminOrStaff()) {
            $stats['totalBooks'] = Book::count();
            $stats['totalMembers'] = User::where('role', 'mahasiswa')->count();
            $stats['activeLoans'] = Loan::where('status', 'approved')->count();
            $stats['overdueLoans'] = Loan::where('status', 'approved')->where('due_date', '<', now())->count();
            $stats['recentLoans'] = Loan::with('book', 'member')->latest()->take(5)->get();
            $stats['recentReturns'] = Loan::where('status', 'returned')->with('book', 'member')->latest()->take(5)->get();

            // Monthly loan trends for the last 12 months
            $stats['monthlyLoans'] = $this->getMonthlyLoanTrends();

            // Category distribution
            $stats['categoryDistribution'] = $this->getCategoryDistribution();
        } else {
            $stats['userLoans'] = Loan::where('member_id', $user->member->id ?? -1)->latest()->take(5)->get();
            $stats['overdueCount'] = Loan::where('member_id', $user->member->id ?? -1)
                ->where('status', 'approved')
                ->where('due_date', '<', now())
                ->count();
        }

        return view('dashboard', compact('stats'));
    }

    /**
     * Get monthly loan trends for the last 12 months
     */
    private function getMonthlyLoanTrends()
    {
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = Loan::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count();
            $monthlyData[] = [
                'month' => $date->format('M Y'),
                'count' => $count
            ];
        }
        return $monthlyData;
    }

    /**
     * Get category distribution data
     */
    private function getCategoryDistribution()
    {
        return Category::withCount('books')
                      ->orderBy('books_count', 'desc')
                      ->get()
                      ->map(function ($category) {
                          return [
                              'name' => $category->name,
                              'count' => $category->books_count,
                              'percentage' => $category->books_count > 0 ?
                                  round(($category->books_count / Book::count()) * 100, 1) : 0
                          ];
                      });
    }
}
