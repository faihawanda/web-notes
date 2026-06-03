<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subtask;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        return view('task.index', [

        'todoTasks' => Task::where('status', 'todo')->latest()->get(),
        'progressTasks' => Task::where('status', 'in-progress')->latest()->get(),
        'doneTasks' => Task::where('status', 'done')->latest()->get(),
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'nullable|string',
        'status' => 'required|in:todo,in-progress,done'
        ]);

        Task::create($validated);  
        return redirect()->back()->with('success', 'Task berhasil ditambahkan!');
    }

    public function storeSubtask(Request $request, Task $task) {
        $request->validate([
        'text' => 'required|string|max:255',
        ]);

        $task->subtasks()->create([
        'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'To-do berhasil ditambahkan!');
    }

    public function destroy(Task $task) {
        $task->delete();

        return redirect()->back()->with('success', 'Project berhasil dihapus!');
    }

    public function updateStatus(Request $request, Task $task) {
        $request->validate([
            'status' => 'required|in:todo,in-progress,done'
        ]);

        $task->update([
            'status' => $request->status
        ]);

            return redirect()->back()->with('success', 'Task status updated successfully!');
    }

    public function destroySubtask(Subtask $subtask) {

        $subtask->delete();

        return redirect()->back()->with('success', 'Subtask berhasil dihapus!');
    }

    public function toggleSubtask(Subtask $subtask) {
        $subtask->update([
            'is_completed' => !$subtask->is_completed
        ]);

        return redirect()->back()->with('success', 'Status subtask berhasil diubah!');
    }

    public function update(Request $request, Task $task){
  
       $validated = $request->validate([
           'title'    => 'required|string|max:255',
           'category' => 'nullable|string',
       ]);

     
       $task->update($validated);
   
       return redirect()->back()->with('success', 'Task berhasil diperbarui!');
   }
}


