<?php

namespace App\Models;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\File;


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
     * Stores the category image
     * @param \Illuminate\Http\UploadedFile $images
     */
    public function storeImage(\Illuminate\Http\UploadedFile $image): void
    {
        $path = $image->store('category_images', 'public');
        $this->image_path = $path;
        $this->save(); // Save after storing each image path
    }

    /**
     * Stores or updates the category
     * return instance of resultant category
     * @param array $categoryData
     * @return Category
     */
    public function setCategory(array $categoryData ): Category
    {
        $this->name = $categoryData['name'];

        if (isset($categoryData['image'])) {
            $this->storeImage($categoryData['image']);
        }

        if (isset($categoryData['parent'])){
            $parentCategoryId = Category::where('name', $categoryData['parent'])->value('id');
            $this->parent_id = $parentCategoryId;
        }

        $this->save();

        return $this;
    }
}
