<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "user_id",
        "trip_id",
        "sub_route_id",
        "ticket_number",
        "seat_number",
        "booking_date",
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * @return BelongsTo
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class, "trip_id")->with(["bus", "route"]);
    }

    /**
     * @return BelongsTo
     */
    public function subRoute(): BelongsTo
    {
        return $this->belongsTo(SubRoute::class, "sub_route_id")
            ->with(['originBusStop', 'destinationBusStop']);
    }

    /**
     * @return HasMany
     */
    public function seats(): HasMany
    {
        return $this->hasMany(TicketSeat::class);
    }

    /**
     * @return HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'ticket_id');
    }
}
