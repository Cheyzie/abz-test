<?php

namespace App\Http\Controllers;

use App\DataTables\PositionsDataTable;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(PositionsDataTable $dataTable) {
        return $dataTable->render('admin.positions.index');
    }
}
