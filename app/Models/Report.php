<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [//fillable property in Laravel is used to define which attributes of a model can be filled when creating or updating a model instance.
        'user_id',
        'city',
        'street',
        'number',
        'status',
        'postal_code',
        'description',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
