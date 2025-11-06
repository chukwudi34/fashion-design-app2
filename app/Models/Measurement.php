<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Measurement extends Model
{
    use HasUuids, HasFactory;

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
}
