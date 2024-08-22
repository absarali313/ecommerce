<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use \Illuminate\Http\UploadedFile;

class Category extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'image_path',
        'parent_id'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'category_product');
    }

    /**
     * Return the number of products associated with a category
     * @return int
     */
    public function getTotalProductsCount(): int
    {
        return $this->products()->count();
    }

    /**
     * Calculate the position for new category
     * @return int
     */
    public static function getNewPosition(): int
    {
        return Category::count() == 0 ? 0 : Category::get()->max('position') + 1 ;
    }
}
