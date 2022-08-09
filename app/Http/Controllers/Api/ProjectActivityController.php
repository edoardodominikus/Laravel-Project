<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProjectActivity;
use Illuminate\Http\Request;
use Validator;

class ProjectActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {   $project_id = $request->input('project_id');
        $task_type = $request->input('task_type');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        $project_activities = ProjectActivity::with('project:id,name')
                                ->where("task_type","=",$task_type)
                                ->where("project_id","=",$project_id)
                                ->whereBetween("dt_added",[$start_date,$end_date])
                                ->get();
        return response()->json([
            "success" => true,
            "message" => "ProjectActivity List",
            "data" => $project_activities
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
            'project_id' => 'required',
            'task_type' => 'required',
            'task_reference_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'parameters' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $project_activity = ProjectActivity::create($input);
        return response()->json([
            "success" => true,
            "message" => "ProjectActivity created successfully.",
            "data" => $project_activity
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
        $project_activity = ProjectActivity::find($id);
        if (is_null($project_activity)) {
            return $this->sendError('ProjectActivity not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "ProjectActivity retrieved successfully.",
            "data" => $project_activity
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectActivity $project_activity)
    {
        $input = $request->all();
        $validator = Validator::make($input, []);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $project_activity->project_id = $input['project_id'];
        $project_activity->task_type = $input['task_type'];
        $project_activity->task_reference_id = $input['task_reference_id'];
        $project_activity->name = $input['name'];
        $project_activity->description = $input['description'];
        $project_activity->parameters = $input['parameters'];
        $project_activity->save();
        return response()->json([
            "success" => true,
            "message" => "ProjectActivity updated successfully.",
            "data" => $project_activity
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectActivity $project_activity)
    {
        $project_activity->delete();
        return response()->json([
            "success" => true,
            "message" => "ProjectActivity deleted successfully.",
            "data" => $project_activity
        ]);
    }
}
