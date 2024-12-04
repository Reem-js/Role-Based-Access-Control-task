@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Task Efficiency</h1>
    <div class="bg-white p-4 rounded shadow-sm">
        <p><strong>Total Tasks:</strong> {{ $totalTasks }}</p>
        <p><strong>Completed Tasks:</strong> {{ $completedTasks }}</p>
        <p><strong>Efficiency:</strong> {{ number_format($efficiency, 2) }}%</p>
    </div>
</div>
@endsection
