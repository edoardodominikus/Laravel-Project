<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Validator;

class TopicController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$pages = Topic::all();
return response()->json([
"success" => true,
"message" => "Topic List",
"data" => $pages
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
'name' => 'required',

]);
if($validator->fails()){
return $this->sendError('Validation Error.', $validator->errors());       
}
$page = Topic::create($input);
return response()->json([
"success" => true,
"message" => "Topic created successfully.",
"data" => $page
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
$page = Topic::find($id);
if (is_null($page)) {
return $this->sendError('Topic not found.');
}
return response()->json([
"success" => true,
"message" => "Topic retrieved successfully.",
"data" => $page
]);
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, Topic $page)
{
$input = $request->all();
$validator = Validator::make($input, [

]);
if($validator->fails()){
return $this->sendError('Validation Error.', $validator->errors());       
}
$page->project_id = $input['project_id'];
$page->name = $input['name'];
$page->description = $input['description'];
$page->active = $input['active'];
$page->save();
return response()->json([
"success" => true,
"message" => "Topic updated successfully.",
"data" => $page
]);
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Topic $page)
{
$page->delete();
return response()->json([
"success" => true,
"message" => "Topic deleted successfully.",
"data" => $page
]);
}
}
