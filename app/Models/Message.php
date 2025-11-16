<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use  HasFactory;

    protected $fillable = [
        'customer_id',
        'subject',
        'content',
        'status',
        'attachment_type',  // ← NEW
        'attachment_path',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Each message belongs to a customer.
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
