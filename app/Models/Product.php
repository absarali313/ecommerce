<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'Visibility'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'category_product');
    }

    public function relatedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_product','product_id','related_product_id');
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(Size::class,  'product_id',);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function prices(): Builder
    {
        return $this->throughSizes()->hasPrices();
    }

    public function scopeCurrentPrice()
    {
        return $this->sizes()->with(['prices' => function ($query) {
            $query->where('started_at', '<=', now())
                ->orderBy('started_at', 'desc')
                ->limit(1);
        }]);
    }

    /**
     * Returns the lowest price from different variations of product
     * @return Price|null
     */
    public function getSmallestPriceAttribute(): Size | null
    {
        // Fetch the minimum price among all sizes related to the product
        $smallestPrice = $this->sizes()
            ->join('prices', 'sizes.id', '=', 'prices.product_size_id')
            ->orderBy('prices.price', 'asc')
            ->select('prices.*')
            ->first();

        return $smallestPrice ?? null;
    }
}
