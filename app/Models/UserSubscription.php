<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $table = 'user_subscriptions';
    protected $primaryKey = 'userSubscriptionID';
    public $timestamps = false;

    protected $fillable = [
        'userID',
        'packageID',
        'accountPackageID',
        'startDate',
        'endDate',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'packageID');
    }

    public function accountPackage()
    {
        return $this->belongsTo(AccountPackage::class, 'accountPackageID');
    }
}
