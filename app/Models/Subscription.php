<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'Subscription';
    protected $primaryKey = 'subscriptionID';
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

    public function payments()
    {
        return $this->hasMany(Payment::class, 'subscriptionID');
    }

    public function wishlistPackages()
    {
        return $this->hasMany(WishlistPackage::class, 'subscriptionID');
    }

    // Relasi: Subscription dimiliki oleh banyak AccountPackage (1-N)
    public function accountPackages()
    {
        return $this->hasMany(AccountPackage::class, 'subscriptionID', 'subscriptionID');
    }
}
