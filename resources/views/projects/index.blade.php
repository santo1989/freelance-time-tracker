@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2>Projects</h2>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">New Project</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->client->name }}</td>
                    <td>
                        <span class="badge bg-{{ $project->status === 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($project->status) }}
                        </span>
                    </td>
                    <td>{{ $project->deadline->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
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