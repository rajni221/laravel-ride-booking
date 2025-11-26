<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = ['passenger_id','driver_id','pickup_lat','pickup_lng','dest_lat','dest_lng','status'];

    public function driver(){
        return $this->belongsTo(Driver::class);
    }

    public function passenger(){
        return $this->belongsTo(Passenger::class);
    }

    // Calculate Distance
    public function scopeDistance($query, $latitude, $longitude, $distance, $unit = "km")
    {
        $constant = ($unit == "km") ? 6371 : 3959; 

        $haversine = "( $constant * acos( cos(radians($latitude)) 
            * cos(radians(pickup_lat)) 
            * cos(radians(pickup_lng) - radians($longitude)) 
            + sin(radians($latitude)) 
            * sin(radians(pickup_lat)) ) )";

        return $query->selectRaw("*, $haversine AS distance")
                    ->having("distance", "<=", $distance);
    }

}
