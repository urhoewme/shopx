<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CartItemsServices;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'deadline'
    ];

    public function cartItems()
    {
        return $this->belongsToMany(CartItem::class, 'cart_items_services', 'service_id', 'cart_item_id');

    }
}
