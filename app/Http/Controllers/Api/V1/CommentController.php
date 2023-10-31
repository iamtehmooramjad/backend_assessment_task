<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(): JsonResponse
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Comment::class);

        $request->validate(Comment::$rules);
        $user = Auth::user();
        // Create a new Comment instance and assign the validated data
        $newComment = new Comment();
        $newComment->user_id = $user->id;
        $newComment->task_id = $request->input('task_id');
        $newComment->comment = $request->input('comment');
        // Set other comment attributes here if needed.

        // Save the new comment to the database
        $newComment->save();
        return redirect()->route('getTask', ['task_id' =>  $newComment->task_id]);
    }

    public function show(Comment $comment): JsonResponse
    {
        return response()->json($comment);
    }

    public function update(Request $request, Comment $comment): JsonResponse
    {
        $request->validate(Comment::$rules);
        $comment->update($request->all());
        return response()->json($comment);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();
        return response()->json(null, 204);
    }
}
