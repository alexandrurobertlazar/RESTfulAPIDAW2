<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'tasks' => Task::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required'
        ]);

        $newTask = Task::create([
            'name' => $request->name,
            'date' => $request->date,
            'status' => 'pending'
        ]);

        return response()->json([
            'task' => $newTask
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'status' => 'pending'
        ]);

        $task->update([
            'name' => $task->name,
            'date' => $task->date
        ]);

        return response()->json([
            'task' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        return response()->json([
            'status' => $task->delete()
        ], 200);
    }

    public function view(Task $task)
    {
        return response()->json([
            'task' => $task
        ]);
    }
}
