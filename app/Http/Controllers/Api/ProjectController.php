<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json([
            "success" => true,
            "message" => "Project List",
            "data" => $projects
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'website' => 'required',
            'email' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'social_media' => 'required',
            'business_type' => 'required',
            'products' => 'required',
            'keywords' => 'required',
            'competitors' => 'required',
            'technical_tasks' => 'required',
            'topics' => 'required',
            'subtopics' => 'required',
            'active' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $project = Project::create($input);
        return response()->json([
            "success" => true,
            "message" => "Project created successfully.",
            "data" => $project
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        if (is_null($project)) {
            return $this->sendError('Project not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Project retrieved successfully.",
            "data" => $project
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $input = $request->all();
        $validator = Validator::make($input, []);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $project->name = $input['name'];
        $project->website = $input['website'];
        $project->email = $input['email'];
        $project->company_name = $input['company_name'];
        $project->address = $input['address'];
        $project->phone = $input['phone'];
        $project->social_media = $input['social_media'];
        $project->business_type = $input['business_type'];
        $project->products = $input['products'];
        $project->keywords = $input['keywords'];
        $project->competitors = $input['competitors'];
        $project->technical_tasks = $input['technical_tasks'];
        $project->topics = $input['topics'];
        $project->subtopics = $input['subtopics'];
        $project->active = $input['active'];
        $project->ordering = $input['ordering'];
        $project->save();
        return response()->json([
            "success" => true,
            "message" => "Project updated successfully.",
            "data" => $project
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json([
            "success" => true,
            "message" => "Project deleted successfully.",
            "data" => $project
        ]);
    }
}
