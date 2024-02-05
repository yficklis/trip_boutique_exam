<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Hotel extends Model
{
    use HasFactory;


    protected $fillable = [
        'tag_id',
        'name',
        'description',
        'description_license',
        'address',
        'rating',
        'facilities'
    ];

    public function agencies(): BelongsToMany
    {
        return $this->belongsToMany(Agency::class);
    }

    public static function verifyAllHotelPropertiesAreOk($hotel): bool
    {
        $listOfProperties = [
            'tag_id',
            'name',
            'description',
            'description_license',
            'address',
            'rating',
            'facilities',
        ];

        foreach ($listOfProperties as $property) {
            if (empty($hotel->$property)) {
                return false;
            }
        }

        return true;
    }

    public static function completeMissingProperties($hotel)
    {
        $defaultHotelCode = 1;
        $defaultHotel = DB::table('hotels')
            ->join('agency_hotel', 'hotel_id', '=', 'hotels.id')
            ->where('hotels.tag_id', '=', $hotel->tag_id)
            ->where('agency_hotel.id', '=', $defaultHotelCode)
            ->first();

        $listOfProperties = [
            'name',
            'description',
            'description_license',
            'address',
            'rating',
            'facilities',
        ];

        foreach ($listOfProperties as $property) {
            if (empty($hotel->$property)) {
                $hotel->$property = $defaultHotel->$property;
            }
        }

        return $hotel;
    }
}
