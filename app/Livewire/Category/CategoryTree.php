<?php

namespace App\Livewire\Category;

use App\Actions\Admin\Category\SaveCategoryProducts;
use App\Actions\Admin\Product\SaveProductCategories;
use App\Models\Category;
use Livewire\Component;

class CategoryTree extends Component
{
    public $categories;
    public $selectedCategory = [];
    public $product;

    public function mount()
    {
        $this->categories = Category::whereNull('parent_id')->get();
    }

    /**
     * Stores the category list in an array
     * @param int $categoryId the category id that needs to be stored
     */
    public function toggle(int $categoryId): void
    {
        if (in_array($categoryId, $this->selectedCategory)) {
            // If the category ID is already selected, remove it from the array
            $this->selectedCategory = array_filter($this->selectedCategory, function($id) use ($categoryId) {
                return $id !== $categoryId;
            });
        } else {
            // If the category ID is not selected, add it to the array
            $this->selectedCategory[] = $categoryId;
        }
        $this->save(new SaveProductCategories());
    }

    /**
     * Saves the association of product and categories
     * @param SaveProductCategories $saveProductCategories
     * @return void
     */
    public function save(SaveProductCategories $saveProductCategories): void
    {
        $saveProductCategories->handle($this->selectedCategory, $this->product);
    }

    public function render()
    {
        return view('livewire.category-tree');
    }
}
