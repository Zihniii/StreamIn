<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistPackage extends Model
{
    protected $table = 'WishlistPackage';
    protected $primaryKey = 'wishlistID';
    public $timestamps = false;

    protected $fillable = [
        'userID',
        'subscriptionID'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscriptionID');
    }
}
