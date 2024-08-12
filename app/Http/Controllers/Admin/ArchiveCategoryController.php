<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class ArchiveCategoryController extends Controller
{
    public function index()
    {
        $categories=Category::onlyTrashed()->simplePaginate(8);

        return view('admin.category.archive.index', [
            'categories'=> $categories,
        ]);
    }

    public function update(Category $category)
    {
        $category->restore(); // Restore the soft-deleted product

        return redirect()->back();
    }
}
