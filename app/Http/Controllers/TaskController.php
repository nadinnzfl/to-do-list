<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|min:3'
        ]);

        Task::create([
            'title' => $request->title,
            'status' => 0,
        ]);

        return redirect('/');
    }

    public function updateStatus(Task $task) {
        $task->status = 1;
        $task->save();

        return redirect('/');
    }

    public function destroy(Task $task){
        $task->delete();

        return redirect('/');
    }
}
