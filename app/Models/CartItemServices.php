<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartItemServices extends Model
{
    use HasFactory;

    public function services(): HasOne
    {
        return $this->hasOne(Service::class);
    }

    public function cartItems(): HasOne
    {
        return $this->hasOne(CartItem::class);
    }
}
