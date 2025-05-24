@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2>Time Logs</h2>
    <a href="{{ route('time-logs.create') }}" class="btn btn-primary">New Time Log</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Duration</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($timeLogs as $log)
                <tr>
                    <td>{{ $log->project->title }}</td>
                    <td>{{ $log->hours }} hours</td>
                    <td>{{ $log->start_time->format('M d, Y') }}</td>
                    <td>{{ Str::limit($log->description, 40) }}</td>
                    <td>
                        <a href="{{ route('time-logs.edit', $log) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form action="{{ route('time-logs.destroy', $log) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection