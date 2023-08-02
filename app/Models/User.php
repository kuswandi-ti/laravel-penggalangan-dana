<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\Campaign;
use App\Models\Donation;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id']; // Supaya semua field bisa otomatis diisi semua, tidak usah menggunakan fillable

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function hasRole($role)
    {
        return $this->role->name == $role;
    }

    public function bank_users()
    {
        return $this->belongsToMany(Bank::class, 'bank_users', 'user_id')
            ->withPivot('account_number', 'account_name')
            ->withTimestamps();
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'user_id', 'id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'user_id', 'id');
    }

    public function scopeDonatur($query)
    {
        return $query->whereHas('role', function ($query) {
            $query->where('name', 'donatur');
        });
    }

    public function main_account()
    {
        return $this->bank_users()
            ->where('is_main', 1)
            ->first();
    }
}
