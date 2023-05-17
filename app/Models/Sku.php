<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = [
        'product_id',
        'count',
        'price',
    ];

    public function product()
    {
        return $this->BelongsTo(Product::class);
    }

    public function propertyOption()
    {
        return $this->belongsToMany(PropertyOption::class);
    }
}
