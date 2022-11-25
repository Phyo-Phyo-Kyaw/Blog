<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function delete($id) {
        $comment = Comment::find($id);
        if(Gate::allows('comment-delete' , $comment)) {
            $comment->delete();
            return back()->with(['info' => "Comment deleted"]);
        }
        return back()->with(['info' => "Unauthorized to delete"]);

    }

    public function create() {
        $validator = validator(request()->all() , [
            "content" => "required" ,
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $comment = new Comment();
        $comment->content = request()->content ;
        $comment->article_id = request()->article_id ;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return back();
    }
}
