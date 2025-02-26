<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Charts\MonthlyOrdersChart;
use App\Charts\MonthlyBookingsChart;
use App\Charts\OrderStatusChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke(
        MonthlyBookingsChart $bookingChart, 
        MonthlyOrdersChart $orderChart, 
        OrderStatusChart $orderStatusChart
    )
    {
        return view('admin.dashboard', [
            'bookingChart' => $bookingChart->build(), 
            'orderChart' => $orderChart->build(),
            'orderStatusChart' => $orderStatusChart->build(),
        ]);
    }
}
