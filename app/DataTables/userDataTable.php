<?php

namespace App\DataTables;

use App\Models\user;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class userDataTable extends DataTable
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
            ->addColumn('action', 'user.action')
            ->addColumn('update user', function ($row) {
                $update = '<a href="' . Route('admin.userEdit', $row->id) . '"  class="edit btn btn-success btn-sm" >update user</a>';
                return $update;
            })
            ->addColumn('user profile', function ($row) {
                if (is_null(User::find($row->id)->profile)) 
                {
                     $profile = '<form action ="'.route('admin.userProfile',$row->id).'" method="POST">
                     '.csrf_field().'
                           <input  type="submit" name="submit" value="add user profile" >
                        </form>'; 
                }
                else
                {
                    $profile =   "user have profile";
                }
                
            
                return $profile;
            })
            
            ->addColumn('deleat Product', function ($row) {
                if(User::find($row->id)->user_type == "admin")
                {
                $deleat = "the user is admin";
                }
                else 
                {
                $deleat = '<form action ="'. route('admin.userDestroy', $row->id).'" method="POST">
                '.csrf_field().'
                '.method_field('delete').'
                <input  onclick="return confirm("Are you sure you want to delete?")" type="submit" name="submit" value="delate user" >
                </form>';
                }
               
                return $deleat;
            })->rawColumns(['deleat Product', 'update user','user profile'])
           ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\user $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(user $model)
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
                    ->setTableId('user-table')
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
            'id','user_type','firstname','lastname','phone','email','update user','deleat Product','user profile'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'user_' . date('YmdHis');

    }
}
