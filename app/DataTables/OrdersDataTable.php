<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class OrdersDataTable extends DataTable
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
            ->rawColumns(['payment_status', 'actions'])

            ->addColumn('client', function(Order $order) {
                return view('admin.orders.columns._client', compact('order'));
            })
            ->addColumn('items', function(Order $order) {
                return  $order->orderItems->count();
            })
            ->addColumn('total_price', function(Order $order) {
                return  '$ ' . $order->total_price;
            })
            ->editColumn('payment_status', function(Order $order) {
                switch ($order->payment_status) {
                    case 'pending':
                        return '<span class="badge bg-warning p-1">Pending</span>';
                    case 'paid':
                        return '<span class="badge bg-success p-1">Paid</span>';
                    default:
                        return '<span class="badge bg-info p-1">Unknown</span>';;
                }
            })
            ->editColumn('created_at', function(Order $order) {
                return $order->created_at->format('Y-m-d H:i');
            })
            ->addColumn('actions', function(Order $order) {
                if (Auth::user()->role === 'admin') {
                    return sprintf('<a class="btn btn-sm btn-primary" href="%s">Show</a>', route('admin.orders.show', $order->id));
                }

                return sprintf('<a class="btn btn-sm btn-primary" href="%s">Show</a>', route('customer.orders.show', $order->id));

            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        if ($this->userId !== null) {
            return $model->newQuery()->where('user_id', $this->userId)->with(['orderItems', 'user', 'payment'])->latest();

        }
        return $model->newQuery()->with(['orderItems', 'user', 'payment'])->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('orders-table')
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
            Column::make('client')->title('Client'),
            Column::make('items')->title('Items'),
            Column::make('total_price')->title('Total Price'),
            Column::make('payment_status')->title('Payment Status'),
            Column::make('created_at')->title('Placed On'),
            Column::computed('actions')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
