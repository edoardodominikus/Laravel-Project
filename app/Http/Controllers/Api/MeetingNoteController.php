<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MeetingNote;
use Illuminate\Http\Request;
use Validator;

class MeetingNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetingnotes = MeetingNote::all();
        return response()->json([
            "success" => true,
            "message" => "MeetingNote List",
            "data" => $meetingnotes
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
            'created_by' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $meetingnote = MeetingNote::create($input);
        return response()->json([
            "success" => true,
            "message" => "MeetingNote created successfully.",
            "data" => $meetingnote
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
        $meetingnote = MeetingNote::find($id);
        if (is_null($meetingnote)) {
            return $this->sendError('MeetingNote not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "MeetingNote retrieved successfully.",
            "data" => $meetingnote
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeetingNote $meetingnote)
    {
        $input = $request->all();
        $validator = Validator::make($input, []);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $meetingnote->project_id = $input['project_id'];
        $meetingnote->meeting_date = $input['meeting_date'];
        $meetingnote->meeting_attendee = $input['meeting_attendee'];
        $meetingnote->meeting_note = $input['meeting_note'];
        $meetingnote->date_create = $input['date_create'];
        $meetingnote->created_by = $input['created_by'];
        $meetingnote->save();
        return response()->json([
            "success" => true,
            "message" => "MeetingNote updated successfully.",
            "data" => $meetingnote
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeetingNote $meetingnote)
    {
        $meetingnote->delete();
        return response()->json([
            "success" => true,
            "message" => "MeetingNote deleted successfully.",
            "data" => $meetingnote
        ]);
    }
}
