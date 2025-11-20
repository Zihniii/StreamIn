<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount';
    protected $primaryKey = 'discountID';
    public $timestamps = false;

    protected $fillable = [
        'discountType',
        'discountValue',
        'discountDescription',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'discountID');
    }
}
