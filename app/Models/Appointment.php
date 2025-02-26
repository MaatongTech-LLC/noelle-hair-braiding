<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'service_id', 'date', 'time', 'status', 'payment_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, 'payable');
    }

    public function scopeConfirmed(Builder $query)
{
    return $query->where('status', 'confirmed');
}

public function scopeToday(Builder $query)
{
    return $query->confirmed()->whereDate('date', Carbon::today());
}

public function scopeThisWeek(Builder $query)
{
    return $query->confirmed()->whereBetween('date', [
        Carbon::now()->startOfWeek(), 
        Carbon::now()->endOfWeek()
    ]);
}

public function scopeThisMonth(Builder $query)
{
    return $query->confirmed()->whereBetween('date', [
        Carbon::now()->startOfMonth(), 
        Carbon::now()->endOfMonth()
    ]);
}

}
