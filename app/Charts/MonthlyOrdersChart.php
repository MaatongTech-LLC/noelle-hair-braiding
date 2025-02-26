<?php

namespace App\Charts;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyOrdersChart
{
    protected $chart;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function build()
    {
        $orderByMonth = \App\Models\Order::selectRaw('MONTH(created_at) as month, count(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = $orderByMonth->pluck('month');
        $orderCounts = $orderByMonth->pluck('total');


        return $this->chart->lineChart()
            ->setTitle('Orders during this year ' . date('Y'))
            ->addData('Orders', $orderCounts->toArray())
            ->setColors(['#ed80c8'])
            ->setFontFamily('Playfair Display, sans-serif, Arial')
            ->setXAxis($months->map(function ($month) {
                return \Carbon\Carbon::create()->month($month)->format('F');
            })->toArray());
    }
}
