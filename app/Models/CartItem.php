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

    public function carts(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function products(): HasOne
    {
        return $this->hasOne(Product::class);
    }

    public function cartItemsServices(): HasMany
    {
        return $this->hasMany(CartItemsServices::class);
    }
}
