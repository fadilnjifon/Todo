<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Task::create(['name' => $request->name]);
        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->is_completed = $request->has('is_completed');
        $task->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return redirect('/');
    }
}
