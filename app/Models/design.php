<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Design extends Model
{
    use  HasFactory;

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
        'part_payment',
        'balance',
        'notes',
    ];

    public function photos()
    {
        return $this->hasMany(DesignPhoto::class);
    }

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        $photo = $this->photos->first();
        return $photo
            ? asset('storage/' . $photo->file_path)
            : null;
    }

    /**
     * Relationship: each design belongs to one customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }
}
