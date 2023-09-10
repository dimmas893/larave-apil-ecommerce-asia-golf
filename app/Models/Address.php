<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $primaryKey = 'id';
    protected $guarded = [];

    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}