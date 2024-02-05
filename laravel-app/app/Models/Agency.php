<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agency extends Model
{
    use HasFactory;

    protected $table = 'agency';

    protected $fillable = ['name'];

    public function agency(): BelongsTo
    {
        return $this->belongsTo(AgencyHotel::class, 'agency_id', 'id');
    }
}
