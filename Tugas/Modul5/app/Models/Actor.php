<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actor extends Model
{
    use HasFactory;

    /**
    * Fillable attributes
    *
    * @var array
    */
    protected $fillable = [
        'actor_name','ranking','film_popular','actor_photo'     
    ];

    /**
    * Get cinema image URL
    *
    * @return Attribute
    */
    protected function actorImage(): Attribute
    {
        return Attribute::make(
            get: fn ($actor_photo) => $actor_photo 
                ? url('/storage/actor/' . $actor_photo) 
                : null,
        );
    }
}
