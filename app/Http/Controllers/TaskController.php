<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
       
        if (auth()->user()->role->name == 'Admin'|| auth()->user()->role->name == 'Manager') {
            $tasks = Task::all();
        } else {
            $tasks = auth()->user()->tasks; 
        }

        return view('tasks.index', compact('tasks')); 
    }

    public function create()
    {
      
        if (auth()->user()->role->name != 'Manager') {
            return redirect()->route('tasks.index'); 
        }
        $users = User::where('role_id', 3)->get(); 

        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in-progress,completed',
            'priority' => 'required|in:low,medium,high',
            'assigned_user_id' => 'nullable|exists:users,id', 
        ]);

  
        $task=Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'assigned_user_id' => $request->assigned_user_id,
        ]);
        $this->assignTaskRoundRobin($task);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $users = User::where('role_id', 3)->get();
        if(auth()->user()->role->name == 'Manager' || auth()->user()->id == $task->assigned_user_id) {
            return view('tasks.edit', compact('task','users'));
        } else {
            return redirect()->route('tasks.index'); 
        }
    }

    public function update(Request $request, Task $task)
    {
        
        if (auth()->user()->role->name == 'Manager') {
            $task->update($request->all());
        } elseif (auth()->user()->role->name == 'User' && auth()->user()->id == $task->assigned_user_id) {
            $task->update($request->only(['status']));
        }

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
      
        if(auth()->user()->role->name == 'Admin') {
            $task->delete();
        }

        return redirect()->route('tasks.index');
    }

    public function calculateEfficiency()
{
    $totalTasks = Task::count();
    $completedTasks = Task::where('status', 'completed')->count();

    if ($totalTasks === 0) {
        $efficiency = 0; 
    } else {
        $efficiency = ($completedTasks / $totalTasks) * 100;
    }

    return view('tasks.efficiency', compact('efficiency', 'totalTasks', 'completedTasks'));
}


public function assignTaskRoundRobin(Task $task)
{
  
    $users = User::whereHas('role', function ($query) {
        $query->where('name', 'User'); 
    })->get();

    if ($users->isEmpty()) {
        return redirect()->back()->with('error', 'No users available for task assignment.');
    }

    $userWithLeastTasks = $users->sortBy(fn($user) => $user->tasks()->where('status', '!=', 'completed')->count())->first();

    $task->assigned_user_id = $userWithLeastTasks->id;
    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Task assigned using round-robin logic.');
}


}

