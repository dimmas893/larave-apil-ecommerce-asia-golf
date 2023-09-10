<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMeta extends Model
{
    use HasFactory;
    protected $table = 'item_metas';
    protected $primaryKey = 'id';
    protected $guarded = [];


}