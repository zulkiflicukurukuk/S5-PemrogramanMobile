<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
    * Fillable attributes
    *
    * @var array
    */
    protected $fillable = [
        'cinema_name','cinema_image','price',
        
    ];

    /**
    * Get cinema image URL
    *
    * @return Attribute
    */
    protected function cinemaImage(): Attribute
    {
        return Attribute::make(
            get: fn ($cinema_image) => $cinema_image 
                ? url('/storage/cinemas/' . $cinema_image) 
                : null,
        );
    }
}
