<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'vehicles';  // Adjust the table name to match your database table

    protected $fillable = ['plate_number', 'model_year', 'image', 'date', 'place', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function vehicleImages()
    {
        return $this->hasMany(VehicleImage::class, 'vehicle_id');
    }
}