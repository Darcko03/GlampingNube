<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking
 *
 * @property $id
 * @property $start_date
 * @property $end_date
 * @property $user_id
 * @property $customer_id
 * @property $subtotal
 * @property $discount
 * @property $tax
 * @property $total
 * @property $created_at
 * @property $updated_at
 *
 * @property Customer $customer
 * @property DomeDetail[] $domeDetails
 * @property ServiceDetail[] $serviceDetails
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Booking extends Model
{
    
    static $rules = [
		'start_date' => 'required',
		'end_date' => 'required',
		'user_id' => 'required',
		'customer_id' => 'required',
		'subtotal' => 'required',
		'discount' => 'required',
		'tax' => 'required',
		'total' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'user_id',
        'start_date',
        'end_date',
        'subtotal',
        'tax',
        'total',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function domes()
    {
        return $this->belongsToMany(Dome::class, 'Dome_Details')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'Service_Details')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}

