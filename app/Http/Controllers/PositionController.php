<?php

namespace App\Http\Controllers;

use App\DataTables\PositionsDataTable;
use App\Http\Requests\PositionCreateRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(PositionsDataTable $dataTable) {
        return $dataTable->render('admin.positions.index');
    }

    public function create() {
        return view('admin.positions.create');
    }

    public function store(PositionCreateRequest $request) {
        $data = $request->validated();

        $data['admin_created_id'] = $request->user()->id;
        $data['admin_updated_id'] = $request->user()->id;

        $position = Position::create($data);

        $position->save();

        return redirect('/admin/employees');
    }
}
