<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = ['uuid', 'name', 'email', 'phone', 'address', 'total', 'status'];

    protected $hidden = [];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($transactioDetail) {
            $transactioDetail->details()->delete();
        });
    }
}
