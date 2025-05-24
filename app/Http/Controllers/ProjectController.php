<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        return Auth::user()->projects()->with('client')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'status' => 'sometimes|in:active,completed',
            'deadline' => 'required|date',
        ]);

        $client = Auth::user()->clients()->findOrFail($validated['client_id']);

        $project = $client->projects()->create($validated);

        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project->client);
        return $project->load('client');
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project->client);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'status' => 'sometimes|in:active,completed',
            'deadline' => 'sometimes|date',
        ]);

        $project->update($validated);

        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project->client);
        $project->delete();
        return response()->noContent();
    }
}
