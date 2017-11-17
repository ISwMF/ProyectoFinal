<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Comment as CommentResource;
use App\Comment;

class CommentController extends Controller {

    public function index() {
        //
    }

    public function store(Request $request) {
      $comment = new Comment;
      $comment->id_user = $request->id_user;
      $comment->id_report = $request->id_report;
      $comment->description = $request->description;
      $comment->save();
      return $comment;
    }

    public function show($id) {
      return new CommentResource(Comment::find($id));
    }

    public function update($id, Request $request) {
      $comment = Comment::find($id);
      $comment->description = $request->description;
      $comment->save();
      return $comment;
    }

    public function destroy($id) {
      Comment::destroy($id);
      response()->json([
        'sucess' => 'Destroyed'
      ]);
    }
}
