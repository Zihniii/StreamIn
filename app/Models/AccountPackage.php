<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountPackage extends Model
{
    protected $table = 'AccountPackage';
    protected $primaryKey = 'accountPackageID';
    public $timestamps = false;

    protected $fillable = [
        'usernamePackage',
        'passwordPackage',
        'validityPackage',
        'startDate',
        'endDate',
        'status',
        'userID'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
