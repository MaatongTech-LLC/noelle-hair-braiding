<?php

namespace App\Charts;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyBookingsChart
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
        $bookingByMonth = \App\Models\Appointment::selectRaw('MONTH(date) as month, count(*) as total')
            ->whereYear('date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = $bookingByMonth->pluck('month');
        $bookingCounts = $bookingByMonth->pluck('total');


        return $this->chart->lineChart()
            ->setTitle('Bookings during this year ' . date('Y'))
            ->addData('Bookings', $bookingCounts->toArray())
            ->setColors(['#ed80c8'])
            ->setFontFamily('Playfair Display, sans-serif, Arial')
            ->setXAxis($months->map(function ($month) {
                return \Carbon\Carbon::create()->month($month)->format('F');
            })->toArray());
    }
}
