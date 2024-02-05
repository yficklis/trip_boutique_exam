<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['name'];


    public function agencies(): BelongsToMany
    {
        return $this->belongsToMany(Agency::class);
    }

    public static function getListHotels(int $clientId)
    {
        $hotelsFromAgency = DB::table('clients')
            ->join('agency_client', 'agency_client.client_id', '=', 'clients.id')
            ->join('agency', 'agency.id', '=', 'agency_client.agency_id')
            ->join('agency_hotel', 'agency_hotel.agency_id', '=', 'agency.id')
            ->join('hotels', 'hotels.id', '=', 'agency_hotel.hotel_id')
            ->where('clients.id', '=', $clientId)
            ->get();

        if ($hotelsFromAgency->isEmpty()) {
            // buscar hoteis default
            return [];
        }

        return $hotelsFromAgency;
    }
}
