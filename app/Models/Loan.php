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
}
