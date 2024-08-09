<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(10);

        return view('admin.category.index', [
            'categories' => $category,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.category.create', [
            'categories' => $categories,
        ]);
    }

    public function edit(Category $category)
    {
        $categories = Category::all();

        return view('admin.category.edit', [
            'categories' => $categories,
            'category' => $category,
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $category = (new Category())->setCategory($request->validated());

        return redirect()->route('admin_categories_edit', $category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->setCategory($request->validated());

        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin_categories');
    }
}
