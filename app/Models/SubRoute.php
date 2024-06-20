<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubRoute extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "trip_id",
        "origin",
        "destination",
        "distance",
        "departure_time",
        "arrival_time",
        "price",
    ];

    /**
     * @return BelongsTo
     */
    public function originBusStop(): BelongsTo
    {
        return $this->belongsTo(BusStop::class, 'origin');
    }

    /**
     * @return BelongsTo
     */
    public function destinationBusStop(): BelongsTo
    {
        return $this->belongsTo(BusStop::class, 'destination');
    }

    /**
     * @return BelongsTo
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class, 'trip_id')->with('bus');
    }
}
