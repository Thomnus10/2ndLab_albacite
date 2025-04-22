@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ $task->title }}</h2>
            <span class="badge bg-{{ $task->is_completed ? 'success' : 'secondary' }}">
                {{ $task->is_completed ? 'Completed' : 'Pending' }}
            </span>
        </div>
        <div class="card-body">
            <p>{{ $task->description }}</p>
            <div class="d-flex gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection