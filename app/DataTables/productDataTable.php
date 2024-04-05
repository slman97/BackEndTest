<?php

namespace App\DataTables;

use App\Models\product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class productDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'product.action')
            ->addColumn('update Product', function ($row) {
                $update = '<a href="' . Route('admin.ProductEdit', $row->id) . '"  class="edit btn btn-success btn-sm" >update Product</i></a>';
                return $update;
            })
            ->addColumn('delete Product', function ($row) {
              $delete =  '<form action ="'. route('admin.ProductDestroy', $row->id).'" method="POST">
                '.csrf_field().'
                '.method_field('delete').'
                <input  onclick="return confirm("Are you sure you want to delete?")" type="submit" name="submit" value="delate product" >
                </form>';
                return $delete;
            })
            ->editColumn('image', function($row){
                $image = '<a><img src="/storage/'.$row->image.'" style="max-width: 200px;"></a>';
                return $image;
            })
            ->rawColumns(['image','delete Product', 'update Product'])
            
           ;
      
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(product $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
           'id','user_id','caption','image','update Product','delete Product'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'product_' . date('YmdHis');
    }
}
