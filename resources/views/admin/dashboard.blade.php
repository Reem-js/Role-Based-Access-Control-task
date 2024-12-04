@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Admin Dashboard</h1>
    <p><strong>Total Tasks:</strong> {{ $totalTasks }}</p>
    <p><strong>Completed Tasks:</strong> {{ $completedTasks }}</p>
    <p><strong>Efficiency:</strong> {{ number_format($efficiency, 2) }}%</p>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Users by Role</h5>
                    <ul class="list-group">
                        @foreach($userCountByRole as $role => $count)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $role }}
                                <span class="badge bg-primary rounded-pill">{{ $count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tasks by Status</h5>
                    <ul class="list-group">
                        @foreach($taskCountByStatus as $status => $count)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ ucfirst($status) }}
                                <span class="badge bg-success rounded-pill">{{ $count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tasks by Priority</h5>
                    <ul class="list-group">
                        @foreach($taskCountByPriority as $priority => $count)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ ucfirst($priority) }}
                                <span class="badge bg-warning rounded-pill">{{ $count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Average Task Completion Time</h5>
                    <p class="card-text">
                        {{ $averageCompletionTime ? round($averageCompletionTime, 2) . ' hours' : 'No completed tasks yet' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
