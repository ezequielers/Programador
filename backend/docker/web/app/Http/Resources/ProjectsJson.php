<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectsJson extends JsonResource
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
            'id'             => $this->pro_id,
            'name'           => $this->pro_name,
            'description'      => $this->pro_description,
            'date_start' => $this->pro_dt_start,
            'date_end'     => $this->pro_dt_end
        ];
    }
}
