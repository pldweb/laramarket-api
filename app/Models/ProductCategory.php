<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasUuids;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'tagline',
        'image',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function childerns()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
