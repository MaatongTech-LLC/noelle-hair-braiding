<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServicesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(ServicesDataTable $dataTable)
    {
        confirmDelete('Delete Service?', 'Do you really want to delete this service?');
        return $dataTable->render('admin.services.index');
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);

        return view('admin.services.show', compact('service'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'deposit_price' => 'required|numeric',
            'type' => 'required',
            'duration' => 'required',
            'service_category_id' => 'required'
        ]);

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('service-images', 'public');
        }

       Service::create($data);

       return redirect()->route('admin.services.index')->with('success', 'Service created successfully');
    }

    public function create()
    {
        $categories = ServiceCategory::all();

        return view('admin.services.create', ['categories' => $categories]);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $categories = ServiceCategory::all();

        return view('admin.services.edit', ['service' => $service, 'categories' => $categories]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'deposit_price' => 'required|numeric',
            'type' => 'required',
            'duration' => 'required',
            'service_category_id' => 'required'

        ]);

        $service = Service::find($id);

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('service-images', 'public');
        }

        $service->update($data);


        return redirect()->route('admin.services.index')->with('success', 'Service Updated Successfully');
    }

    public function destroy($id)
    {
        Service::destroy($id);

        return redirect()->route('admin.services.index')->with('success', 'Service Deleted Successfully');
    }
}
