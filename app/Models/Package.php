<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'Package';
    protected $primaryKey = 'packageID';
    public $timestamps = false;

    protected $fillable = [
        'serviceName',
        'packageType',
        'durasiPackage',
        'hargaPackage',
        'logoSubscription',
        'imageSubscription',
        'descriptionPackage',
        'descriptionDurasi'
    ];

     public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'packageID');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'packageID');
    }

    public function wishlistPackages()
    {
        return $this->hasMany(WishlistPackage::class, 'packageID');
    }

    // Relasi: Subscription dimiliki oleh banyak AccountPackage (1-N)
    public function accountPackages()
    {
        return $this->hasMany(AccountPackage::class, 'packageID', 'packageID');
    }
}
