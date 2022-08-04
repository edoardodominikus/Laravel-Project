<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return response()->json([
            "success" => true,
            "message" => "Article List",
            "data" => $articles
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
            'content' => 'required',
            'topics' => 'required',
            'notes' => 'required',
            'status' => 'required',
            'dt_requested' => 'required',
            'dt_received' => 'required',
            'dt_drafted' => 'required',
            'dt_published' => 'required',
            'dt_promoted' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $article = Article::create($input);
        return response()->json([
            "success" => true,
            "message" => "Article created successfully.",
            "data" => $article
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
        $article = Article::find($id);
        if (is_null($article)) {
            return $this->sendError('Article not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Article retrieved successfully.",
            "data" => $article
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $input = $request->all();
        $validator = Validator::make($input, []);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $article->project_id = $input['project_id'];
        $article->page_id = $input['page_id'];
        $article->name = $input['name'];
        $article->content = $input['content'];
        $article->topics = $input['topics'];
        $article->notes = $input['notes'];
        $article->status = $input['status'];
        $article->dt_requested = $input['dt_requested'];
        $article->dt_received = $input['dt_received'];
        $article->dt_drafted = $input['dt_drafted'];
        $article->dt_published = $input['dt_published'];
        $article->dt_promoted = $input['dt_promoted'];
        $article->marketing = $input['marketing'];
        $article->save();
        return response()->json([
            "success" => true,
            "message" => "Article updated successfully.",
            "data" => $article
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            "success" => true,
            "message" => "Article deleted successfully.",
            "data" => $article
        ]);
    }
}
