<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'description',
        'status',
        'photo',
        'design_date',
        'fabric_type',
        'color',
        'style',
        'occasion',
        'special_instructions',
        'first_fitting',
        'final_fitting',
        'completion_date',
        'delivery_date',
        'estimated_price',
        'final_price',
        'notes',
    ];

    public function photos()
    {
        return $this->hasMany(DesignPhoto::class);
    }

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : null;
    }

    /**
     * Relationship: each design belongs to one customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}