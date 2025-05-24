<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClientController extends Controller
{
    use AuthorizesRequests;
   
    public function index()
    {
        return Auth::user()->clients; // Changed from auth()->user()
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_person' => 'required|string|max:255',
        ]);

        $client = Auth::user()->clients()->create($validated);

        return response()->json($client, 201);
    }

    // In all methods using authorize(), add dependency injection:
    public function show(Client $client)
    {
        $this->authorize('view', $client);
        return $client;
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email',
            'contact_person' => 'sometimes|string|max:255',
        ]);

        $client->update($validated);

        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        $client->delete();
        return response()->noContent();
    }
}
