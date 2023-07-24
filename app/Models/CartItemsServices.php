<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class CartItemsServices extends Model
{
    use HasFactory;

    public function service(): MorphToMany
    {
        return $this->morphedByMany(Service::class);
    }

    public function cartItem(): MorphToMany
    {
        return $this->morphedByMany(CartItem::class);
    }
}
