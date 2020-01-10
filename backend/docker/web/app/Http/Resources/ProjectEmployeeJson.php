<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectEmployeeJson extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->pem_id,
            'project_id'           => $this->pem_project_id,
            'employee_id'      => $this->pem_employee_id,
            'manager' => $this->pem_manager
        ];
    }
}
