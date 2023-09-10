<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPhoto extends Model
{
    use HasFactory;
    protected $table = 'item_photos';
    protected $primaryKey = 'id';

    protected $guarded = [];
}