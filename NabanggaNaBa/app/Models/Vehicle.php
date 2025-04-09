<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VehicleImage;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number', 'model_year', 'date', 'place', 'status', 'user_id'
    ];

    // Define the one-to-many relationship with VehicleImage
    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }
}