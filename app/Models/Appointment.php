<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location_id',
        'dealer_id',
        'market_id',
        'drop_off',
        'request_datetime',
        'requested_services',
        'comments',
        'vehicle_year',
        'vehicle_make',
        'vehicle_model',
        'vehicle_option',
        'first_name',
        'last_name',
        'email',
        'phone',
        'preferred_contact_method',
    ];
    /**
     * Define the relationship with the Dealer model.
     */
    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    /**
     * Define the relationship with the Market model.
     */
    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    /**
     * Define the relationship with the Location model.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
