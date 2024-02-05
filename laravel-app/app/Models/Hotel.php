<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    public function checkIfPropertiesIsNotEmpty(object $hotel): bool
    {

        foreach ($this->fillable as $property) {
            if (empty($hotel->$property)) {
                return false;
            }
        }
        return true;
    }

    public function completeMissingProperties(object $hotel): object
    {
        return $this->fillEmptyHotelAttribute($hotel);
    }

    private function getHotelDefaultByTagId(String $tagId)
    {
        $defaultHotelCode = config('constants.defaultHotel');

        return DB::table('hotels')
            ->join('agency_hotel', 'hotel_id', '=', 'hotels.id')
            ->where('hotels.tag_id', '=', $tagId)
            ->where('agency_hotel.id', '=', $defaultHotelCode)
            ->first();
    }

    private function fillEmptyHotelAttribute(object $hotel): object
    {
        $defaultHotel = $this->getHotelDefaultByTagId($hotel->tag_id);
        
        foreach ($this->fillable as $property) {
            if (empty($hotel->$property)) {
                $hotel->$property = empty($defaultHotel->$property) ? '' : $defaultHotel->$property;
            }
        }
        return $hotel;
    }

    public static function validInsertNewHotel($request)
    {
        $data = $request->all();
        if (!isset($data['tag_id']) || empty($data['tag_id'])) {
            throw new HttpException(302, 'The tag id cannot by empty.');
        }

        if (!isset($data['agency_id']) || empty($data['agency_id']) || !Agency::find($data['agency_id'])) {
            throw new HttpException(302, 'The selected agency does not exist.');
        }

        $data['facilities'] = (isset($data['facilities'])) ?  json_encode($data['facilities']) : '';
        return $data;
    }
}
