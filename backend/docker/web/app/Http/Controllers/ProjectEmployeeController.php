<?php

namespace App\Http\Controllers;

use App\Models\ProjectEmployee;

use App\Http\Resources\ProjectEmployeeCollection;
use App\Http\Resources\ProjectEmployeeJson;
use App\Http\Requests\ProjectEmployeeRequest;

class ProjectEmployeeController extends Controller
{
    public function index($idProject)
    {
        $projectEmployee = ProjectEmployee::where('pem_project_id', $idProject)
            ->join('projects', 'project_employee.pem_project_id', '=', 'projects.pro_id')
            ->join('employees', 'project_employee.pem_employee_id', '=', 'employees.emp_id')->get();
        return new ProjectEmployeeCollection($projectEmployee);
    }

    public function store(ProjectEmployeeRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $contains = ProjectEmployee::where('pem_project_id', $request->get('project_id'))
                ->where('pem_employee_id', $request->get('employee_id'))->first();
            if (empty($contains)) {
                $project = new ProjectEmployee([
                    'pem_project_id' => $request->get('project_id'),
                    'pem_employee_id' => $request->get('employee_id'),
                    'pem_manager' => $request->get('manager')
                ]);
                $project->save();
                return new ProjectEmployeeJson($project);
            } else {
                return response()->json('Employee already belongs to the project');
            }
        }
    }

    public function delete($id)
    {
        $projectEmployee = ProjectEmployee::find($id);
        if (!empty($projectEmployee)) {
            $projectEmployee->delete();
            return response()->json('Record deleted successfully!');
        } else {
            return response()->json('Record not found.');
        }
    }
}
