<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountPackage extends Model
{
    protected $table = 'accountpackage';

    protected $primaryKey = 'accountPackageID';

    public $timestamps = false;

    protected $fillable = [
        'packageID',
        'usernamePackage',
        'passwordPackage',
        'validityPackage',
        'status',
    ];

    // AccountPackage -> UserSubscription (1 - many)
    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'accountPackageID');
    }
}
