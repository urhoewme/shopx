<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\CartItemsServices;

class CartItem extends Model
{
    use HasFactory;

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'cart_items_services', 'cart_item_id', 'service_id');
    }
}
