<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Client;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    public function index()
    {
        $hotels = Client::getListHotels(5);

        foreach ($hotels as $hotel) {
            if (Hotel::verifyAllHotelPropertiesAreOk($hotel)) {
                continue;
            }

            Hotel::completeMissingProperties($hotel);
        }

        die(json_encode($hotels));
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
