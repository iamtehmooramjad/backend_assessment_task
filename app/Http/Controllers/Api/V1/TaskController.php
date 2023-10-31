<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        if ($name){
            $tasks = Task::where('name', 'like', '%' . $name . '%')->paginate(5);
        }
        else{
            $tasks =Task::paginate(5);
        }

        return view('/home', compact('tasks'));

    }

    public function getTask($task_id)
    {
        $task = Task::find($task_id);
        $task->viewed = Date::now();
        $task->save();
        $task = Task::with('comments.user')->find($task_id);
        $comments = $task->comments;
        return view('/comments.comments', compact('task','comments'));

    }

    public function store(Request $request): JsonResponse
    {
        $request->validate(Task::$rules);
        $user = Auth::user();
        $task = $user->tasks()->create($request->all());
        return response()->json($task, 201);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json($task);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $request->validate(Task::$rules);
        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
