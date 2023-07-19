<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'deadline'
    ];
    public function save(array $options = [])
    {
        return parent::save($options); // TODO: Change the autogenerated stub
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
