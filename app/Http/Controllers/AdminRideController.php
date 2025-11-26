<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ride;

class AdminRideController extends Controller
{
    public function index()
    {
        $rides = Ride::with('passenger','driver')->get();

        return view('admin.rides.index', compact('rides'));

    }

    public function show($id)
    {
        $ride = Ride::with('passenger','driver')->findOrFail($id);

        return view('admin.rides.show', compact('ride'));
    }
}
