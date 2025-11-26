<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;
use App\Models\Ride;


class PassengerController extends Controller
{
    public function createPassenger(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $passenger = Passenger::create($request->all());

        return response()->json($passenger, 201);
    }

    public function createRide(Request $request){

        $dataValidated = $request->validate([
            'passenger_id' => 'required|exists:passengers,id',
            'pickup_lat' => 'required|numeric',
            'pickup_lng' => 'required|numeric',
            'dest_lat' => 'required|numeric',
            'dest_lng' => 'required|numeric'
        ]);
        
        $ride = Ride::create($dataValidated);

        return response()->json($ride, 201);
    }

    public function approveDriver(Request $request)
    {
        $request->validate([
            'ride_id' => 'required|exists:rides,id',
            'driver_id' => 'required|exists:drivers,id'
        ]);

        $ride = Ride::findorfail($request->ride_id);
        $ride->update([
            'driver_id' => $request->driver_id, 
            'status' => 'driver_approved'
        ]);
        
        return response()->json($ride);
    }

    public function completeByPassenger(Request $request)
    {
        $request->validate([
            'ride_id' => 'required|exists:rides,id'
        ]);

        $ride = Ride::find($request->ride_id);
        $ride->passenger_completed = true;
        
        if($ride->driver_completed){
            $ride->status = 'completed';
        }else{
            $ride->status = 'completed_by_passenger';
        }

        $ride->save();

        return response()->json($ride);

    }
}
