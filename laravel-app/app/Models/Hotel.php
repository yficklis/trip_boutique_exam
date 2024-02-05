<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $fillable = [
        'name',
        'description',
        'description_license',
        'address',
        'rating',
        'facilities'
    ];

    public function agency(): BelongsTo
    {
        return $this->belongsTo(AgencyHotel::class, 'hotel_id', 'id');
    }
}
