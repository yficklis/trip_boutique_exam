<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        return Clients::all();
    }

    public function store(Request $request)
    {
        return Clients::all();
    }

    public function show(Clients $clients)
    {
        return Clients::all();
    }

    public function update(Request $request, Clients $clients)
    {
        return Clients::all();
    }

    public function destroy(Clients $clients)
    {
        return Clients::all();
    }
}
