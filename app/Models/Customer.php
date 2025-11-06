<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Customer extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'notes',
        'status',
    ];

    public function designs()
{
    return $this->hasMany(Design::class);
}

public function measurements()
{
    return $this->hasMany(Measurement::class);
}

public function messages()
{
    return $this->hasMany(Message::class);
}

}
