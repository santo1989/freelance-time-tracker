<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TimeLogController extends Controller
{
    use AuthorizesRequests;
    public function start(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'description' => 'nullable|string',
        ]);

        $project = Project::findOrFail($validated['project_id']);
        $this->authorize('view', $project->client);

        $timeLog = TimeLog::create([
            'project_id' => $validated['project_id'],
            'start_time' => now(),
            'description' => $validated['description'],
        ]);

        return response()->json($timeLog, 201);
    }

    public function end(TimeLog $timeLog)
    {
        $this->authorize('update', $timeLog);

        $timeLog->update([
            'end_time' => now(),
            'hours' => $timeLog->calculateHours(),
        ]);

        return response()->json($timeLog);
    }

    public function index()
    {
        return Auth::user()->timeLogs()->with('project.client')->get();
    }

    public function update(Request $request, TimeLog $timeLog)
    {
        $this->authorize('update', $timeLog);

        $validated = $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'description' => 'nullable|string',
        ]);

        $timeLog->update([
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'hours' => Carbon::parse($validated['end_time'])->diffInHours($validated['start_time']),
            'description' => $validated['description'],
        ]);

        return response()->json($timeLog);
    }

    public function destroy(TimeLog $timeLog)
    {
        $this->authorize('delete', $timeLog);
        $timeLog->delete();
        return response()->noContent();
    }
}
