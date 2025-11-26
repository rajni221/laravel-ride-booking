<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Ride;

class DriverController extends Controller
{
    public function createDriver(Request $request)
    {   
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $driver = Driver::create($request->all());

        return response()->json([
            'message' => 'Driver created successfully',
            'driver' => $driver,
            'status' => 201
        ]);
    }

    public function updateLocation(Request $request)
    {   
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);

        $driver = Driver::find($request->driver_id);
        $driver->update([
            'lat' =>$request->lat,
            'lng' => $request->lng
        ]);

        return response()->json(['status' => 'location updated']);
    }

    public function nearbyRides(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);

        $lat = $request->lat;
        $lng = $request->lng;
        $radius = 5; //Km

        $rides = Ride::where('status', 'pending')
            ->distance($lat, $lng, $radius, 'km')
            ->orderBy('distance')
            ->get();
        
        return response()->json($rides);

    }

    public function requestRide(Request $request)
    {
        $request->validate([
            'ride_id' => 'required|exists:rides,id',
            'driver_id' => 'required|exists:drivers,id'
        ]); 

        $ride = Ride::find($request->ride_id);
        
        $ride->update([
            'driver_id' => $request->driver_id, 
            'status' => 'driver_requested'
        ]);


        return response()->json($ride);
    }

    public function completeByDriver(Request $request)
    {
        $request->validate([
            'ride_id' => 'required|exists:rides,id'
        ]);

        $ride = Ride::find($request->ride_id);
        $ride->driver_completed = true;

        if($ride->passenger_completed){
            $ride->status = 'completed';
        }else{
            $ride->status = 'completed_by_driver';
        }

        $ride->save();

        return response()->json($ride);
    }
}
