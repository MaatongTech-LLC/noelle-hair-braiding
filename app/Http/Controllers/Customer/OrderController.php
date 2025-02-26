<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public OrdersDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = new OrdersDataTable(Auth::id());
    }
    public function index()
    {
        return $this->dataTable->render('admin.orders.index');
    }

    public function show(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        return view('customer.orders.show', ['order' => $order]);
    }
}
