<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'userID';
    public $timestamps = false;

    protected $fillable = [
        'usernamePengguna',
        'emailPengguna',
        'passwordPengguna',
        'fotoProfil'
    ];

    public function accountPackages()
    {
        return $this->hasMany(AccountPackage::class, 'userID');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'userID');
    }

    public function wishlistPackages()
    {
        return $this->hasMany(WishlistPackage::class, 'userID');
    }

    public function reportIssues()
    {
        return $this->hasMany(ReportIssue::class, 'userID');
    }

    public function chatTickets()
    {
        return $this->hasMany(ChatTicket::class, 'userID');
    }
}
