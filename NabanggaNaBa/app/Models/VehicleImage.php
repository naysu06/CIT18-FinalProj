<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id', 'image'
    ];

    // Define the inverse of the relationship (each image belongs to a vehicle)
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}