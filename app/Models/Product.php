<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Translatable;

    protected $fillable = [
        'name',
        'code',
        'category_id',
        'description',
        'image',
        'new',
        'hit',
        'recommend',
        'name_en',
        'description_en',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function skus()
   {
        return $this->hasMany(Sku::class);
   }

   public function properties()
   {
        return $this->belongsToMany(Property::class, 'property_product')->withTimestamps();
   }

    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }

    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }


    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }

    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }

    public function isHit()
    {
        return !!$this->hit;
    }

    public function isNew()
    {
        return !!$this->new;
    }

    public function isRecommend()
    {
        return !!$this->recommend;
    }
}
