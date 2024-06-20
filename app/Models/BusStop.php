<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusStop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany
     */
    public function origins(): HasMany
    {
        return $this->hasMany(SubRoute::class, 'origin');
    }

    /**
     * @return HasMany
     */
    public function destinations(): HasMany
    {
        return $this->hasMany(SubRoute::class, 'destination');
    }
}
