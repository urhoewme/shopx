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

    public function cartItemsServices(): HasMany
    {
        return $this->hasMany(CartItemsServices::class);
    }
}
