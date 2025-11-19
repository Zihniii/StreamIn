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

    // Override default auth column names
    public function getAuthIdentifierName()
    {
        return 'userID';
    }

    public function getAuthPassword()
    {
        return $this->passwordPengguna;
    }

    // Untuk reset password
    public function getEmailForPasswordReset()
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
