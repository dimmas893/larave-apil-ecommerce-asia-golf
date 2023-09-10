<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Item extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function wishlist()
    {
        return $this->hasOne(Wishlist::class, 'product_id', 'id');
    }

    public function itemVariant()
    {
        return $this->hasMany(ItemVariant::class, 'item_id', 'id');
    }

    public function itemMeta()
    {
        return $this->hasOne(ItemMeta::class, 'item_id', 'id');
    }

    public function itemDiscount()
    {
        return $this->hasOne(ItemDiscount::class, 'item_id', 'id');
    }

    public function itemBundlingDetails()
    {
        return $this->hasOne(ItemBundlingDetails::class, 'item_id', 'id');
    }

    function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }
    function stock()
    {
        return $this->hasMany(Stock::class, 'item_id', 'id');
    }
    function itemPhoto()
    {
        return $this->hasMany(ItemPhoto::class, 'item_id', 'id');
    }
    function itemReview()
    {
        return $this->hasMany(ItemReview::class, 'item_id', 'id');
    }
    function discussion()
    {
        return $this->hasMany(Discussion::class, 'item_id', 'id');
    }

    function discount()
    {
        return $this->hasOne(ItemDiscount::class, 'item_id', 'id');
    }
}
