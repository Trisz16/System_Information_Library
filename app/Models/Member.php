<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'status',
        'membership_date',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'membership_date' => 'date',
    ];

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
