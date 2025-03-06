<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\DataTables\ProductCategoriesDataTable;

class ProductCategoryController extends Controller
{
    public function index(ProductCategoriesDataTable $dataTable)
    {
        confirmDelete('Delete Category', 'Do you want to delete this category?');

        return $dataTable->render('admin.product-categories.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ProductCategory::create($validated);

        toast('Successfully Created!', 'success');

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = ProductCategory::findOrFail($id);
        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function edit(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        return view('admin.product-categories.edit', ['category' => $category]);
    }

    public function destroy($id)
    {
        ProductCategory::destroy($id);

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
