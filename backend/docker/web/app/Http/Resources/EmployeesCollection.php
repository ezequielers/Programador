<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Employee;

class EmployeesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function(Employee $employee) {
            return [
                'emp_id' => $employee->emp_id,
                'emp_name' => $employee->emp_name
            ];
        });
    }
}
