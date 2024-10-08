<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    // List all employees
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    // Add a new employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'number' => 'required|string',
            'employee_id' => 'required|string|unique:employees,employee_id',
            'joining_date' => 'required|date',
            'department' => 'required|string',
            'password' => 'required|string',
            'salary_monthly' => 'required|numeric',
            'designation' => 'required|string',
            'senior_name' => 'nullable|string',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'employee_id' => $request->employee_id,
            'joining_date' => $request->joining_date,
            'department' => $request->department,
            'password' => Hash::make($request->password),
            'salary_monthly' => $request->salary_monthly,
            'designation' => $request->designation,
            'senior_name' => $request->senior_name,
        ]);

        return response()->json(['message' => 'Employee added successfully', 'employee' => $employee], 201);
    }

    // Edit an employee
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:employees,email,' . $id,
            'number' => 'sometimes|required|string',
            'employee_id' => 'sometimes|required|string|unique:employees,employee_id,' . $id,
            'joining_date' => 'sometimes|required|date',
            'department' => 'sometimes|required|string',
            'password' => 'sometimes|required|string',
            'salary_monthly' => 'sometimes|required|numeric',
            'designation' => 'sometimes|required|string',
            'senior_name' => 'nullable|string',
        ]);

        $employee->update([
            'name' => $request->name ?? $employee->name,
            'email' => $request->email ?? $employee->email,
            'number' => $request->number ?? $employee->number,
            'employee_id' => $request->employee_id ?? $employee->employee_id,
            'joining_date' => $request->joining_date ?? $employee->joining_date,
            'department' => $request->department ?? $employee->department,
            'password' => $request->password ? Hash::make($request->password) : $employee->password,
            'salary_monthly' => $request->salary_monthly ?? $employee->salary_monthly,
            'designation' => $request->designation ?? $employee->designation,
            'senior_name' => $request->senior_name ?? $employee->senior_name,
        ]);

        return response()->json(['message' => 'Employee updated successfully', 'employee' => $employee], 200);
    }

    // Delete an employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
}
