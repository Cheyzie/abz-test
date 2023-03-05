<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    public function employees(Request $request) {
        $query = $request->get('query');
        $data = Employee::select('full_name')
            ->where('full_name', 'like', '%'.$query.'%')
            ->limit(5)
            ->get()
            ->map(fn ($user) => $user->full_name);

        return response()->json($data);
    }
}
