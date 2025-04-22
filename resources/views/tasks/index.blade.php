@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Task Manager</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
    </div>

    @if($tasks->isEmpty())
        <div class="alert alert-info">No tasks found. Create one!</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ Str::limit($task->description, 50) }}</td>
                        <td>
                            <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm {{ $task->is_completed ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $task->is_completed ? 'Completed' : 'Pending' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection