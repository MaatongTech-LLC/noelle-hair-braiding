<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->rawColumns(['product', 'category'])
            ->editColumn('product', function(Product $product) {
                return view('admin.products.columns._product', compact('product'));
            })
            ->addColumn('category', function(Product $product) {
                return ucwords($product->category->name);
            })
            ->editColumn('price', function(Product $product) {
                return '$' .  $product->price;
            })
            ->editColumn('description', function(Product $product) {
                return  substr($product->description, 0, 75);
            })
            ->editColumn('stock', function(Product $product) {
                return $product->stock;
            })
            ->editColumn('created_at', function(Product $product) {
                return $product->created_at->diffForHumans();
            })
            ->addColumn('actions', function(Product $product) {
                return view('admin.products.columns._actions', compact('product'));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery()->with('category')->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('products-table')
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
            Column::make('product')->addClass('d-flex align-items-center')->title('Product'),
            Column::make('category')->title('Category'),
            Column::make('price')->title('Price'),
            Column::make('description')->title('Description'),
            Column::make('stock')->title('Stock'),
            Column::make('created_at')->title('Added'),
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
        return 'Products_' . date('YmdHis');
    }
}
