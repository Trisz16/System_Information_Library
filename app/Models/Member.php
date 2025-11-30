<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'user_id',
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

    /**
     * Get the user associated with this member profile
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Check if member profile is complete
     */
    public function isProfileComplete()
    {
        return !empty($this->name) &&
               !empty($this->email) &&
               !empty($this->address) &&
               !empty($this->date_of_birth) &&
               !empty($this->gender);
    }
}
