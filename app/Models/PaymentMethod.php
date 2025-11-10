<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'PaymentMethod';
    protected $primaryKey = 'paymentMethodID';
    public $timestamps = false;

    protected $fillable = [
        'QRIS',
        'BCA',
        'BNI',
        'Mandiri'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'paymentMethodID');
    }
}
