<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeesDataTable;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Models\Position;
use App\Services\PhotoService;

class EmployeeController extends Controller
{
    public function index(EmployeesDataTable $dataTable) {
        return $dataTable->render('admin.employees.index');
    }

    public function create() {
        $positions = Position::all();
        return view('admin.employees.create', ['positions' => $positions]);
    }

    public function store(EmployeeCreateRequest $request) {
        $data = $request->validated();

        $data['head_id'] = $data['head']
            ? Employee::where('full_name', $data['head'])
                ->first()->id
            : null;
        unset($data['head']);

        if($data['photo']) {
            $data['photo'] = PhotoService::save($request->file('photo'));
        }

        $data['admin_created_id'] = $request->user()->id;
        $data['admin_updated_id'] = $request->user()->id;

        $employee = new Employee($data);

        $employee->save();

        return redirect(url('/admin/employees'));
    }

    public function edit(Employee $employee) {
        $positions = Position::all();
        return view('admin.employees.edit', ['employee' => $employee, 'positions' => $positions]);
    }

    public function update(Employee $employee, EmployeeUpdateRequest $request) {
        $data = $request->validated();

        $data['head_id'] = $data['head']
            ? Employee::where('full_name', $data['head'])
                ->first()->id
            : null;
        unset($data['head']);

        if($data['photo']) {
            $data['photo'] = PhotoService::save($request->file('photo'));
        }

        $data['admin_updated_id'] = $request->user()->id;

        $employee->fill($data);

        $employee->save();

        return redirect('admin/employees');
    }

    public function destroy(Employee $employee) {
        $employee->delete();

        return response()->json(['deleted'=>1]);
    }
}
