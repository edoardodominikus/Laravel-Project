<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OnpageTask;
use Illuminate\Http\Request;
use Validator;

class OnpageTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $onpage_tasks = OnpageTask::all();
        return response()->json([
            "success" => true,
            "message" => "OnpageTask List",
            "data" => $onpage_tasks
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
            'key' => 'required',
            'name' => 'required',
            'description' => 'required',
            'active' => 'required',
            'ordering' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $onpage_task = OnpageTask::create($input);
        return response()->json([
            "success" => true,
            "message" => "OnpageTask created successfully.",
            "data" => $onpage_task
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
        $onpage_task = OnpageTask::find($id);
        if (is_null($onpage_task)) {
            return $this->sendError('OnpageTask not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "OnpageTask retrieved successfully.",
            "data" => $onpage_task
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OnpageTask $onpage_task)
    {
        $input = $request->all();
        $validator = Validator::make($input, []);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $onpage_task->key = $input['key'];
        $onpage_task->name = $input['name'];
        $onpage_task->description = $input['description'];
        $onpage_task->active = $input['active'];
        $onpage_task->save();
        return response()->json([
            "success" => true,
            "message" => "OnpageTask updated successfully.",
            "data" => $onpage_task
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnpageTask $onpage_task)
    {
        $onpage_task->delete();
        return response()->json([
            "success" => true,
            "message" => "OnpageTask deleted successfully.",
            "data" => $onpage_task
        ]);
    }
}
