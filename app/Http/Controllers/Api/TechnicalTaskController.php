<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TechnicalTask;
use Illuminate\Http\Request;
use Validator;

class TechnicalTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technical_tasks = TechnicalTask::all();
        return response()->json([
            "success" => true,
            "message" => "TechnicalTask List",
            "data" => $technical_tasks
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
        $technical_task = TechnicalTask::create($input);
        return response()->json([
            "success" => true,
            "message" => "TechnicalTask created successfully.",
            "data" => $technical_task
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
        $technical_task = TechnicalTask::find($id);
        if (is_null($technical_task)) {
            return $this->sendError('TechnicalTask not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "TechnicalTask retrieved successfully.",
            "data" => $technical_task
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TechnicalTask $technical_task)
    {
        $input = $request->all();
        $validator = Validator::make($input, []);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $technical_task->key = $input['key'];
        $technical_task->name = $input['name'];
        $technical_task->description = $input['description'];
        $technical_task->active = $input['active'];
        $technical_task->save();
        return response()->json([
            "success" => true,
            "message" => "TechnicalTask updated successfully.",
            "data" => $technical_task
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TechnicalTask $technical_task)
    {
        $technical_task->delete();
        return response()->json([
            "success" => true,
            "message" => "TechnicalTask deleted successfully.",
            "data" => $technical_task
        ]);
    }
}
