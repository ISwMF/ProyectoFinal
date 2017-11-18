<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use App\Http\Resources\Comment as CommentResource;
use App\Http\Controllers\Controller;
use App\comment;

class CommentController extends Controller {

    public function index() {
        $comments = comment::all();
        return $comments;
    }

    public function store(Request $request) {
      $comment = new comment;
      $comment->id_user = $request->id_user;
      $comment->id_report = $request->id_report;
      $comment->description = $request->description;
      $comment->save();
      return $comment;
    }

    public function show($id) {
      $comment = comment::find($id);
      return $comment;
      //return new CommentResource(Comment::find($id));
    }

    public function update($id, Request $request) {
      $comment = comment::find($id);
      $comment->description = $request->description;
      $comment->save();
      return $comment;
    }

    public function destroy($id) {
      comment::destroy($id);
      response()->json([
        'sucess' => 'Destroyed'
      ]);
    }
}
