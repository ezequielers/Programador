<?php

namespace App\Http\Controllers;

use App\Models\Employee;

use App\Http\Resources\EmployeesCollection;
use App\Http\Resources\EmployeesJson;
use App\Http\Requests\EmployeesRequest;

class EmployeesController extends Controller
{
    public function index()
    {
        return new EmployeesCollection(Employee::all());
    }

    public function listAvaliable ($idProject)
    {
        $listEmployee = Employee::whereNotIn('emp_id', function($query) use ($idProject) {
            $query->select('pem_employee_id')
                ->from('project_employee')
                ->where('pem_project_id', $idProject);
        })->get();
        return new EmployeesCollection($listEmployee);
    }

    public function store(EmployeesRequest $request)
    {
		$validated = $request->validated();
		if ($validated) {
            $employee = null;
            if (!empty($request->get('id'))) {
                $employee = Employee::find($request->get('id'));
            }
            if (!empty($employee)) {
                $employee->emp_name = $request->get('name');
            } else {
                $employee = new Employee([
                    'emp_name' => $request->get('name')
                ]);
            }
			$employee->save();
			return new EmployeesJson($employee);
		}
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        if (!empty($employee)) {
            $employee->delete();
            return response()->json('Record deleted successfully!');
        } else {
            return response()->json('Record not found.');
        }
    }
}
