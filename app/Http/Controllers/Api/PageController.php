<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Validator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return response()->json([
            "success" => true,
            "message" => "Page List",
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
            'url' => 'required',
            'page_title' => 'required',
            'keywords' => 'required',
            'topics' => 'required',
            'notes' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $page = Page::create($input);
        return response()->json([
            "success" => true,
            "message" => "Page created successfully.",
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
        $page = Page::find($id);
        if (is_null($page)) {
            return $this->sendError('Page not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Page retrieved successfully.",
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
    public function update(Request $request, Page $page)
    {
        $input = $request->all();
        $validator = Validator::make($input, []);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $page->project_id = $input['project_id'];
        $page->url = $input['url'];
        $page->page_title = $input['page_title'];
        $page->keywords = $input['keywords'];
        $page->topics = $input['topics'];
        $page->notes = $input['notes'];
        $page->type = $input['type'];
        $page->save();
        return response()->json([
            "success" => true,
            "message" => "Page updated successfully.",
            "data" => $page
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json([
            "success" => true,
            "message" => "Page deleted successfully.",
            "data" => $page
        ]);
    }
}
