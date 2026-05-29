<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return view('task-board', [
            'todoTasks' => Task::where('status', 'todo')->get(),
            'progressTasks' => Task::where('status', 'progress')->get(),
            'doneTasks' => Task::where('status', 'done')->get(),
        ]);
    }

    public function create()
    {
        return "Form create task nanti di sini";
    }
}
