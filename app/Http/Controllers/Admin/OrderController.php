<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.index');
    }

    public function show(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.show', ['order' => $order]);
    }
}
