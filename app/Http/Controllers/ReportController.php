<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    use AuthorizesRequests;
    public function report(Request $request)
    {
        $query = Auth::user()->timeLogs()
            ->with(['project.client'])
            ->select('project_id', DB::raw('SUM(hours) as total_hours'))
            ->groupBy('project_id');

        if ($request->has('client_id')) {
            $query->whereHas('project', fn($q) =>
            $q->where('client_id', $request->client_id));
        }

        if ($request->has('from')) {
            $query->whereDate('start_time', '>=', $request->from);
        }

        if ($request->has('to')) {
            $query->whereDate('end_time', '<=', $request->to);
        }

        $results = $query->get();

        return response()->json([
            'total_hours' => $results->sum('total_hours'),
            'entries' => $results
        ]);
    }
}
