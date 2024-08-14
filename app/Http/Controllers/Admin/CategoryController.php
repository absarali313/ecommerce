<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Category\CreateCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.category.create', [
            'categories' => Category::all(),
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'categories' => Category::all(),
            'category' => $category,
        ]);
    }

    public function store(CategoryRequest $request, CreateCategory $createCategoryAction)
    {
        $category = new Category();
        $createCategoryAction->handle($request->validated(), $category);

        return redirect()->route('admin_category_edit', $category);
    }

    public function update(CategoryRequest $request, Category $category, CreateCategory $createCategoryAction)
    {
        $createCategoryAction->handle($request->validated(), $category);

        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin_categories');
    }
}
