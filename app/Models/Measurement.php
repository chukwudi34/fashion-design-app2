<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Measurement extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'measurement_date',
        'notes',
        'measurements',
        'categories',
    ];

    // 🧩 Automatically convert JSON to array when retrieved
    protected $casts = [
        'measurements' => 'array',
        'categories' => 'array',
        'measurement_date' => 'date',

        'data' => 'array',

    ];

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
