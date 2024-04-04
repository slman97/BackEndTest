<?php

namespace App\DataTables;

use App\Models\User;
use Auth;
use App\Models\product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class productUserDataTable extends DataTable
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
            ->editColumn('image', function($row){
                $image = '<a><img src="/storage/'.$row->image.'" style="max-width: 200px;"></a>';
                return $image;
            }) ->rawColumns(['image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(product $model)
    {
        $product = Product::where("user_id", Auth::user());
        return Product::query()
        ->where("user_id", Auth::user()->id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('productuser-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
            'id','user_id','caption','image'  
           ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'productUser_' . date('YmdHis');
    }
}
