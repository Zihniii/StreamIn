<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Created by Muhammad Naufal Erwin E 5026231152

class WishlistPackage extends Model
{
    protected $table = 'WishlistPackage';

    protected $primaryKey = 'wishlistID';

    public $timestamps = false;

    protected $fillable = [
        'userID',
        'packageID',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    // Relasi ke Package
    public function package()
    {
        return $this->belongsTo(Package::class, 'packageID', 'packageID');
    }
}