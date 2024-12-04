@extends('layouts.app')

@section('content')
<style>
    .table th, .table td {
        text-align: center;
    }
    
    .table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }
    
    .table td {
        vertical-align: middle;
    }

    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.875rem;
    }
</style>

<div class="container mt-5">
    <h1 class="mb-4">Task Management</h1>

    @if(auth()->user()->role->name == 'Manager')
        <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">Create Task</a>
    @endif
    @if(auth()->user()->role->name == 'Admin')
   
        <a href="{{ route('admin.dashboard') }}" class="btn btn-success mb-3">Admin Dashboard</a>
   
   @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->user->name }}</td> 
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td class="d-flex justify-content-around">
             
                        @if(auth()->user()->role->name == 'Manager' || auth()->user()->id == $task->assigned_user_id)
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($tasks->isEmpty())
        <div class="alert alert-info">No tasks available.</div>
    @endif
</div>

@endsection
