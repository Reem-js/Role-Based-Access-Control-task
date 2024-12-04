@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-control, .btn {
        border-radius: 5px;
    }

    .form-control:focus {
        border-color: #4CAF50; 
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.5); 
    }

    .btn {
        width: 100%;
        padding: 10px;
        font-size: 1.1rem;
        background-color: #4CAF50;
        color: white;
        border: none;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
    }
</style>

<div class="form-container">
    <h2>Create a New Task</h2>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Enter task title" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" placeholder="Enter task description"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="in-progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <select id="priority" name="priority" class="form-control">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="assigned_user_id">Assigned User</label>
            <select id="assigned_user_id" name="assigned_user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn">Create Task</button>
    </form>
</div>
@endsection
