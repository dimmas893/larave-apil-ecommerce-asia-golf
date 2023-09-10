<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $table = 'discussions';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function discussionAnswer()
    {
        return $this->hasMany(discussionAnswer::class, 'discussion_id', 'id');
    }
}