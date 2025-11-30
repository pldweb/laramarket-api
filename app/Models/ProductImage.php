<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'product_id',
        'image',
        'is_thumbnail',
    ];

    protected $casts = [
        'is_thumbnail' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
