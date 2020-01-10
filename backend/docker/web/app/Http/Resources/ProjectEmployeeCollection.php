<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\ProjectEmployee;

class ProjectEmployeeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function(ProjectEmployee $projectEmployee) {
            return [
                'pem_id' => $projectEmployee->pem_id,
                'pem_project_id' => $projectEmployee->pem_project_id,
                'pem_employee_id' => $projectEmployee->pem_employee_id,
                'pem_employee_name' => $projectEmployee->emp_name,
                'pem_manager' => $projectEmployee->pem_manager
            ];
        });
    }
}
