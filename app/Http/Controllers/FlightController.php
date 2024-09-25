<?php

namespace App\Http\Controllers;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function search(Request $request) {
        $request->validate([
            'from' => 'required|string',
            'flight_date' => 'required|date',
        ]);
    
        $flights = Flight::where('departure_city', $request->from) 
                         ->where('departure_date', $request->flight_date)
                         ->get();
    
        return response()->json($flights);
    }
    
}
