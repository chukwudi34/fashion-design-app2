<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DesignPhoto extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'design_id',
        'file_path',
        'file_name',
    ];

    protected $appends = ['url'];

    public function design()
    {
        return $this->belongsTo(Design::class);
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
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
