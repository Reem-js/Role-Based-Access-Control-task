<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role->name !== 'Admin') {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }
 
        $userCountByRole = User::select('role_id')
            ->with('role')
            ->get()
            ->groupBy('role.name')
            ->map(fn($users) => $users->count());

       
        $taskCountByStatus = Task::select('status')
            ->get()
            ->groupBy('status')
            ->map(fn($tasks) => $tasks->count());

    
        $taskCountByPriority = Task::select('priority')
            ->get()
            ->groupBy('priority')
            ->map(fn($tasks) => $tasks->count());

       
        $averageCompletionTime = Task::whereNotNull('completed_at')
            ->get()
            ->map(fn($task) => Carbon::parse($task->created_at)->diffInHours(Carbon::parse($task->completed_at)))
            ->average();
        
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'completed')->count();
        $efficiency = $totalTasks ? ($completedTasks / $totalTasks) * 100 : 0;
        return view('admin.dashboard', compact(
            'userCountByRole',
            'taskCountByStatus',
            'taskCountByPriority',
            'averageCompletionTime',
            'totalTasks', 'completedTasks', 'efficiency'
        ));
    }
}
