<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index()
    {
        return Agency::all();
    }

    public function store(Request $request)
    {
        return Agency::all();
    }

    public function show(Agency $agency)
    {
        return Agency::all();
    }

    public function update(Request $request, Agency $agency)
    {
        return Agency::all();
    }

    public function destroy(Agency $agency)
    {
        return Agency::all();
    }
}
