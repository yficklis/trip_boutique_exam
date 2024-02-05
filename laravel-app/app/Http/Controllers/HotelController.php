<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    public function index()
    {
        $user = 1;
        return Hotel::find($user)->agencies;
    }

    public function store(Request $request)
    {
        return Hotel::all();
    }

    public function show(Hotel $hotel)
    {
        return Hotel::all();
    }

    public function update(Request $request, Hotel $hotel)
    {
        return Hotel::all();
    }

    public function destroy(Hotel $hotel)
    {
        return Hotel::all();
    }
}
