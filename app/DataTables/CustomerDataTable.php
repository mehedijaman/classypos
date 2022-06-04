<?php

namespace ClassyPOS\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use ClassyPOS\shop\Shop;
use ClassyPOS\customer\Customer;
use ClassyPOS\customer\CustomerBalance;
use ClassyPOS\customer\CustomerLedger;
use Validator;
use Input;
use Auth;
use ClassyPOS\user\UserRoleCategory;
use ClassyPOS\user\UserRole;
use ClassyPOS\user\ActivityLog;
use ClassyPOS\bank\Bank;
use ClassyPOS\bank\BankLedger;
use ClassyPOS\bank\BankBalance;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session; 

use Yajra\Datatables\Datatables;

class CustomerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'customerdatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \ClassyPOS\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $Customer = new Customer;
        $CustomerList = $Customer->listCustomer();
        
        return $this->applyScopes($CustomerList);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'add your columns',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'customerdatatable_' . time();
    }
}
