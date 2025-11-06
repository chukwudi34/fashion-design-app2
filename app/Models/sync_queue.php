<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SyncQueue extends Model
{
    use HasUuids,HasFactory;

    protected $table = 'sync_queue'; // explicit table name since not plural

    protected $primaryKey = 'id';
    public $incrementing = false; // since id is a string (UUID)
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'timestamp',
        'operation',
        'entity_type',
        'data',
        'attempts',
        'last_attempt',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
        'timestamp' => 'datetime',
        'last_attempt' => 'datetime',
    ];

//     protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($model) {
//         if (empty($model->id)) {
//             $model->id = (string) \Illuminate\Support\Str::uuid();
//         }
//     });
// }

}
