<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'office_phone',
        'office_address',
        'office_state',
        'office_city',
        'office_zip',
        'mailchimp_form_action',
        'holiday_sets'
    ];


    /**
     * Get the full name attribute.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the coupons for the dealer.
     */
    public function coupons(){
        return $this->hasMany(Coupon::class);
    }

    /**
     * Get the locations for the dealer.
     */
    public function locations(){
        return $this->hasMany(Location::class);
    }

    /**
     * Define the inverse relationship with the Appointment model.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
