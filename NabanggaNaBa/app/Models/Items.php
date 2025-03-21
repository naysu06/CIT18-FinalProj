<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'plate_number',
        'model_year',
        'image',
        'date',
        'place',
    ];

    /**
     * Create a new vehicle record.
     */
    public static function createVehicle($data)
    {
        return self::create($data);
    }

    /**
     * Read a vehicle record by ID.
     */
    public static function readVehicle($id)
    {
        return self::find($id);
    }

    /**
     * Update a vehicle record by ID.
     */
    public static function updateVehicle($id, $data)
    {
        $vehicle = self::find($id);
        return $vehicle ? $vehicle->update($data) : null;
    }

    /**
     * Delete a vehicle record by ID.
     */
    public static function deleteVehicle($id)
    {
        $vehicle = self::find($id);
        return $vehicle ? $vehicle->delete() : null;
    }
}
