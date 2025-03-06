<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        confirmDelete('Delete Product?', 'Are you sure you want to delete this product?');

        return $dataTable->render('admin.products.index');
    }

    public function create()
    {
        $categories = ProductCategory::all();

        return view('admin.products.create', ['categories' => $categories]);
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();

        return view('admin.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'product_category_id' => 'required|exists:product_categories,id',
        ]);


        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('product-images', 'public');
        }

       Product::create($data);

       return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'product_category_id' => 'required|exists:product_categories,id',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('product-images', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
