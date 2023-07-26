<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'title',
        'description',
        'image',
        'price'
    ];

    public $sortable = [
        'title',
        'price'
    ];

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

//    protected function getPrice(): Attribute
//    {
//        return Attribute::make(
//            get: fn ()
//        )
//    }
}
