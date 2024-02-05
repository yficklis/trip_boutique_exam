<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agency extends Model
{
    use HasFactory;

    protected $table = 'agency';

    protected $fillable = ['name'];

    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class);
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class);
    }
}
