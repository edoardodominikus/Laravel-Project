<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MonthlyTask;
use Illuminate\Http\Request;
use Validator;

class MonthlyTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthly_tasks = MonthlyTask::all();
        return response()->json([
            "success" => true,
            "message" => "MonthlyTask List",
            "data" => $monthly_tasks
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
        $monthly_task = MonthlyTask::create($input);
        return response()->json([
            "success" => true,
            "message" => "MonthlyTask created successfully.",
            "data" => $monthly_task
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
        $monthly_task = MonthlyTask::find($id);
        if (is_null($monthly_task)) {
            return $this->sendError('MonthlyTask not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "MonthlyTask retrieved successfully.",
            "data" => $monthly_task
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthlyTask $monthly_task)
    {
        $input = $request->all();
        $validator = Validator::make($input, []);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $monthly_task->key = $input['key'];
        $monthly_task->name = $input['name'];
        $monthly_task->description = $input['description'];
        $monthly_task->active = $input['active'];
        $monthly_task->save();
        return response()->json([
            "success" => true,
            "message" => "MonthlyTask updated successfully.",
            "data" => $monthly_task
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthlyTask $monthly_task)
    {
        $monthly_task->delete();
        return response()->json([
            "success" => true,
            "message" => "MonthlyTask deleted successfully.",
            "data" => $monthly_task
        ]);
    }
}
