<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'dealer_id',
        'status',
        'description',
        'service_type',
        'barcode_text',
        'coupon_footer',
        'expiration_date',
        'renewal_options',
        'ppc'
    ];

    /**
     * Get the dealer that owns the coupon.
     */
    public function dealer(){
        return $this->belongsTo(Dealer::class);
    }

    // Define the relationship with the Location model
    public function locations()
    {
        // Assuming your intermediate table name is coupon_location
        return $this->belongsToMany(Location::class, 'coupon_location');
    }
}
