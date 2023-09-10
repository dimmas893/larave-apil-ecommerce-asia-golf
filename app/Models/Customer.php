<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $guarded = [];

    protected $fillable = ["user_id"];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'customer_id', 'id');
    }

    function cart()
    {
        return $this->hasOne(Cart::class, 'customer_id', 'id');
    }
}