<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'tanggal_peminjaman' => 'datetime',
        'tanggal_pengembalian' => 'datetime',
        'tanggal_jatuh_tempo' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_anggota',
        'id_buku',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'tanggal_jatuh_tempo',
        'status',
        'catatan',
    ];

    /**
     * Get the user that owns the loan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_anggota');
    }

    /**
     * Get the book that owns the loan.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'id_buku');
    }

    /**
     * Get the loaning details for the loan.
     */
    public function loaningDetails(): HasMany
    {
        return $this->hasMany(LoaningDetail::class, 'id_peminjaman');
    }
}
