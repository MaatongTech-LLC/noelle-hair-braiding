<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Appointment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AppointmentsDataTable extends DataTable
{

    public $userId;

    public function __construct($userId = null) {
        $this->userId = $userId;
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->rawColumns(['status', 'payment_type', 'action'])
            ->editColumn('date', function(Appointment $appointment) {
                return $appointment->date;
            })
            ->editColumn('time', function(Appointment $appointment) {
                return $appointment->time;
            })
            ->addColumn('client', function(Appointment $appointment) {
                return $appointment->user->name;
            })
            ->addColumn('service', function(Appointment $appointment) {
                return $appointment->service->name;
            })
            ->addColumn('status', function(Appointment $appointment) {
                switch ($appointment->status) {
                    case 'pending':
                        return '<span class="badge bg-warning p-1">Pending</span>';
                    case 'confirmed':
                        return '<span class="badge bg-success p-1">Confirmed</span>';
                    case 'completed':
                        return '<span class="badge bg-info p-1">Completed</span>';
                    case 'cancelled':
                        return '<span class="badge bg-danger p-1">Cancelled</span>';
                    default:
                        return 'Unknown';
                }
            })
            ->addColumn('payment_type', function(Appointment $appointment) {
                switch ($appointment->payment_type) {
                    case 'deposit':
                        return '<span class="p-1">Deposit</span>';
                    case 'full_price':
                        return '<span class="p-1">Full Price</span>';
                    default:
                        return 'Unknown';
                }
            })
            ->editColumn('created_at', function(Appointment $appointment) {
                return $appointment->created_at->format('Y-m-d');
            })
            ->addColumn('action', function(Appointment $appointment) {
                if (Auth::user()->role === 'admin') {
                    return sprintf('<a class="btn btn-sm btn-primary" href="%s">Show</a>', route('admin.booking.show', $appointment->id));
                }
                return sprintf('<a class="btn btn-sm btn-primary" href="%s">Show</a>', route('customer.booking.show', $appointment->id));

            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Appointment $model): QueryBuilder
    {
        if ($this->userId !== null) {
            return $model->newQuery()->where('user_id', $this->userId)->with(['user', 'service'])->latest('id');
        }
        return $model->newQuery()->with(['user', 'service'])->latest('id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('bookings-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('date')->title('Date'),
            Column::make('time')->title('Time'),
            Column::make('client')->title('Client'),
            Column::make('service')->title('Service'),
            Column::make('status')->title('Status'),
            Column::make('payment_type')->title('Payment Type'),
            Column::make('created_at')->title('Booked On'),
            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(60)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Appointments_' . date('YmdHis');
    }
}
