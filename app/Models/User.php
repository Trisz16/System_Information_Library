<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is staff
     */
    public function isStaff()
    {
        return $this->hasRole('staff');
    }

    /**
     * Check if user is mahasiswa (Indonesian for student)
     */
    public function isMahasiswa()
    {
        return $this->hasRole('mahasiswa');
    }

    /**
     * Check if user is student (alias for mahasiswa)
     */
    public function isStudent()
    {
        return $this->isMahasiswa();
    }

    /**
     * Check if user has admin or staff role
     */
    public function isAdminOrStaff()
    {
        return $this->isAdmin() || $this->isStaff();
    }

    /**
     * Get the member profile associated with this user
     */
    public function member()
    {
        return $this->hasOne(\App\Models\Member::class);
    }

    /**
     * Get the notifications for this user
     */
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }
}
