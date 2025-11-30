<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'book_id',
        'member_id',
        'loan_date',
        'due_date',
        'return_date',
        'fine',
        'status',
        'notes',
    ];

    protected $casts = [
        'loan_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
        'fine' => 'decimal:2',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Check if loan is pending approval
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if loan is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if loan is rejected
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if loan is active (approved but not returned)
     */
    public function isActive()
    {
        return $this->status === 'approved' && is_null($this->return_date);
    }

    /**
     * Check if loan is returned
     */
    public function isReturned()
    {
        return $this->status === 'returned';
    }

    /**
     * Check if loan is overdue
     */
    public function isOverdue()
    {
        return $this->isActive() && $this->due_date->isBefore(now()->startOfDay());
    }

    /**
     * Calculate fine amount
     */
    public function calculateFine()
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        $daysLate = ceil($this->due_date->diffInDays(now()->startOfDay(), false));
        return $daysLate * 5000; // Rp 5,000 per day
    }
}
