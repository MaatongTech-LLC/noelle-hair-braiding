<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Order;
use Carbon\Carbon;

class OrderStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
    

    public function build()
    {
        $currentYear = Carbon::now()->year;

        // Get order count for the current year grouped by status
        $statusCounts = Order::whereYear('created_at', $currentYear)
            ->selectRaw('payment_status, COUNT(*) as count')
            ->groupBy('payment_status')
            ->pluck('count', 'payment_status')
            ->toArray();

        return $this->chart->pieChart()
            ->setTitle('Orders by Status (This Year)')
            ->setSubtitle("From January to " . Carbon::now()->format('F'))
            ->addData(array_values($statusCounts))
            ->setLabels(array_keys($statusCounts));
    }
}
