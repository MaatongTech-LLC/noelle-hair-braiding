<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServiceCategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index(ServiceCategoriesDataTable $dataTable)
    {
        confirmDelete('Delete Category', 'Do you want to delete this category?');

        return $dataTable->render('admin.service-categories.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ServiceCategory::create($validated);

        return redirect()->route('admin.serviceCategories.index')->with('success', 'Category created successfully.');
    }

    public function create()
    {
        return view('admin.service-categories.create');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = ServiceCategory::findOrFail($id);
        $category->update($validated);

        return redirect()->route('admin.serviceCategories.index')->with('success', 'Category updated successfully.');
    }

    public function edit(Request $request, $id)
    {
        $category = ServiceCategory::findOrFail($id);

        return view('admin.service-categories.edit', ['category' => $category]);
    }

    public function destroy($id)
    {
        ServiceCategory::destroy($id);
       
        return redirect()->route('admin.serviceCategories.index')->with('success', 'Category deleted successfully.');
    }
}
