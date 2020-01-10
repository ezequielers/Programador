<?php

namespace App\Http\Controllers;

use App\Models\Project;

use App\Http\Resources\ProjectsCollection;
use App\Http\Resources\ProjectsJson;
use App\Http\Requests\ProjectsRequest;

class ProjectsController extends Controller
{
    public function index($id = null)
    {
        if (!empty($id)) {
            $project = Project::where('pro_id', $id)->get();
            return new ProjectsCollection($project);
        } else {
            return new ProjectsCollection(Project::all());
        }
    }

    public function store(ProjectsRequest $request)
    {
		$validated = $request->validated();
		if ($validated) {
            $project = null;
		    if (!empty($request->get('id'))) {
                $project = Project::find($request->get('id'));
            }
		    if (!empty($project)) {
                $project->pro_name = $request->get('name');
                $project->pro_description = $request->get('description');
                $project->pro_dt_start = $request->get('dt_start');
                $project->pro_dt_end = $request->get('dt_end');
            } else {
                $project = new Project([
                    'pro_name' => $request->get('name'),
                    'pro_description' => $request->get('description'),
                    'pro_dt_start' => $request->get('dt_start'),
                    'pro_dt_end' => $request->get('dt_end')
                ]);
            }
			$project->save();
			return new ProjectsJson($project);
		}
    }

    public function delete($id)
    {
        $project = Project::find($id);
        if (!empty($project)) {
            $project->delete();
            return response()->json('Record deleted successfully!');
        } else {
            return response()->json('Record not found.');
        }
    }
}
