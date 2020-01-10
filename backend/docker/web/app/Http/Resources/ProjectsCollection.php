<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Project;

class ProjectsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function(Project $project) {
            return [
                'pro_id' => $project->pro_id,
                'pro_name' => $project->pro_name,
                'pro_description' => $project->pro_description,
                'pro_dt_start' => $project->pro_dt_start,
                'pro_dt_end' => $project->pro_dt_end
            ];
        });
    }
}
