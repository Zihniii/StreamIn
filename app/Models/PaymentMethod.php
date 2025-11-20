<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'paymentmethod';
    protected $primaryKey = 'paymentMethodID';
    public $timestamps = false;

    protected $fillable = [
        'methodName',
        'icon',
        'detail',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'paymentMethodID');
    }
}
