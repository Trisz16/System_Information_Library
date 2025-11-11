<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoaningDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_peminjaman',
        'id_buku',
        'jumlah_peminjaman',
        'denda',
        'catatan',
    ];

    /**
     * Get the loan that owns the loaning detail.
     */
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class, 'id_peminjaman');
    }

    /**
     * Get the book that owns the loaning detail.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'id_buku');
    }
}
