<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Client;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HotelController extends Controller
{

    public function index()
    {
        $hotels = Hotel::all();
        return response()->json($hotels);
    }

    public function store(Request $request)
    {
        try {
            $data = Hotel::validInsertNewHotel($request);
            $hotel = Hotel::create($data);
            $agency = Agency::findOrFail($data['agency_id']);
            $agency->hotels()->attach($hotel->id);
            return response()->json($hotel, 201);
        } catch (HttpException $e) {
            throw new HttpResponseException(response()->json(['error' => $e->getMessage()], $e->getStatusCode()));
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json(['error' => 'Internal Server Error'], 500));
        }
    }

    public function show($id)
    {
        try {
            $hotel = Hotel::findOrFail($id);
            return response()->json($hotel, 200);
        } catch (HttpException $e) {
            throw new HttpResponseException(response()->json(['error' => $e->getMessage()], $e->getStatusCode()));
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json(['error' => 'Internal Server Error'], 500));
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Hotel::validInsertNewHotel($request);
            $hotel = Hotel::findOrFail($id);
            $hotel->update($data);
            $hotel->agencies()->sync([$data['agency_id']]);
            return response()->json($hotel);
        } catch (HttpException $e) {
            throw new HttpResponseException(response()->json(['error' => $e->getMessage()], $e->getStatusCode()));
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json(['error' => 'Internal Server Error'], 500));
        }
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return response()->json(null, 204);
    }

    public function search($clientId): string
    {
        try {
            $data = Client::getListHotelsByClientId($clientId);
            if ($data->isEmpty()) {
                throw new HttpException(404, 'No hotels found for this customer ID');
            }

            foreach ($data as $key => $hotel) {
                $hotelModel = new Hotel();
                if ($hotelModel->checkIfPropertiesIsNotEmpty($hotel)) {
                    continue;
                }

                $data[$key] = $hotelModel->completeMissingProperties($hotel);
            }
            return response()->json(['data' => $data], 200);
        } catch (HttpException $e) {
            throw new HttpResponseException(response()->json(['error' => $e->getMessage()], $e->getStatusCode()));
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json(['error' => 'Internal Server Error'], 500));
        }
    }
}
