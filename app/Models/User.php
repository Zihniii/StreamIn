<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'User';
    protected $primaryKey = 'userID';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'usernamePengguna',
        'emailPengguna',
        'passwordPengguna',
        'fotoProfil'
    ];

    protected $hidden = [
        'passwordPengguna',
    ];

    // Override default auth identifier
    public function getAuthIdentifierName()
    {
        return 'userID';
    }

    // Override default auth password column
    public function getAuthPassword()
    {
        return $this->passwordPengguna;
    }

    // For password reset
    public function getEmailForPasswordReset()
    {
        return $this->emailPengguna;
    }

    // Accessor agar bisa pakai $user->name
    public function getNameAttribute()
    {
        return $this->usernamePengguna;
    }

    // Accessor agar bisa pakai $user->email
    public function getEmailAttribute()
    {
        return $this->emailPengguna;
    }

    // Relationships
     public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'userID');
    }
    
    public function accountPackages()
    {
        return $this->hasMany(AccountPackage::class, 'userID', 'userID');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'userID', 'userID');
    }

    public function wishlistPackages()
    {
        return $this->hasMany(WishlistPackage::class, 'userID', 'userID');
    }

    public function reportIssues()
    {
        return $this->hasMany(ReportIssue::class, 'userID', 'userID');
    }

    public function chatTickets()
    {
        return $this->hasMany(ChatTicket::class, 'userID', 'userID');
    }
}
