<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'Payment';

    protected $primaryKey = 'paymentID';

    public $timestamps = false;

    protected $fillable = [
        'paymentStatus',
        'amount',
        'adminFee',
        'discount',
        'paymentDate',
        'discountDescription',
        'userID',
        'paymentMethodID',
        'packageID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentMethodID');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscriptionID');
    }
}
