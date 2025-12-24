<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    // Sesuaikan nama tabel dengan database kamu
    // Berdasarkan PaymentController fixed di atas, kita gunakan 'usersubscription'
    protected $table = 'user_subscriptions';

    protected $primaryKey = 'userSubscriptionID';

    public $timestamps = false; // Set true jika tabel punya created_at/updated_at

    protected $fillable = [
        'userID',
        'packageID',
        'accountPackageID',
        'startDate',
        'endDate',
        'status', // active, expired, cancelled
    ];

    protected $casts = [
        'startDate' => 'datetime',
        'endDate' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    // Relasi ke Package (Netflix Premium, dll)
    public function package()
    {
        return $this->belongsTo(Package::class, 'packageID');
    }

    // Relasi ke AccountPackage (Akun email/pass yang diberikan ke user)
    public function accountPackage()
    {
        return $this->belongsTo(AccountPackage::class, 'accountPackageID');
    }
}
