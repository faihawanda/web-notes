<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subtask;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('task-board', [
            // Pastikan string status sesuai dengan database kamu nanti
            'todoTasks'     => Task::where('status', 'todo')->latest()->get(),
            'progressTasks' => Task::where('status', 'in-progress')->latest()->get(),
            'doneTasks'     => Task::where('status', 'done')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'nullable|string',
            'status'   => 'required|in:todo,in-progress,done'
        ]);

        // Simpan ke database
        Task::create($validated);

        // Kembalikan ke halaman board dengan pesan sukses
        return redirect()->back()->with('success', 'Task berhasil ditambahkan!');
    }


    public function storeSubtask(Request $request, Task $task)
    {
        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        // Simpan subtask baru otomatis nempel ke ID task utamanya
        $task->subtasks()->create([
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'To-do berhasil ditambahkan!');
    }

    public function destroy(Task $task)
    {
        // Menghapus kartu utama beserta seluruh subtask di dalamnya secara otomatis (cascade)
        $task->delete();

        return redirect()->back()->with('success', 'Project berhasil dihapus!');
    }
}
