<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'paymentID';
    public $timestamps = false;

    protected $fillable = [
        'paymentStatus',
        'amount',
        'adminFee',
        'paymentDate',
        'userID',
        'paymentMethodID',
        'packageID',
        'discountID', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentMethodID');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'packageID');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discountID');
    }
}
