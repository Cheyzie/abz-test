<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeesDataTable;

class EmployeeController extends Controller
{
    public function index(EmployeesDataTable $dataTable) {
        return $dataTable->render('admin.employees.index');
    }
}
