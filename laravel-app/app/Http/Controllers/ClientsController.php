<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Clients::all();
        return response()->json($clients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',

        ]);

        $client = Clients::create($request->all());

        return response()->json($client, 201);
    }

    public function show($id)
    {
        $client = Clients::find($id);
        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        return response()->json($client);
    }

    public function update(Request $request, $id)
    {
        $client = Clients::find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $request->validate([
            'name' => 'required|string'
        ]);

        $client->update($request->all());

        return response()->json($client);
    }

    public function destroy($id)
    {
        $client = Clients::find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Client deleted']);
    }
}
