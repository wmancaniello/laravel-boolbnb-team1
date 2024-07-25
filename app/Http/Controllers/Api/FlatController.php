<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flat;
use App\Models\Service;
use Carbon\Carbon;

class FlatController extends Controller
{
    public function index(Request $request)
    {
        $serviceIds = $request->services;
        $minBeds = $request->beds;
        $minRooms = $request->rooms;

        $flats = Flat::query()
            ->with('sponsors')
            ->visibleFlats()
            ->minBeds($minBeds)
            ->minRooms($minRooms)
            ->when(!empty($serviceIds), function ($query) use ($serviceIds) {
                return $query->withAllServices($serviceIds);
            })
            ->orderBy('beds', 'asc')
            ->orderBy('rooms', 'asc')
            ->get();

        $currentDate = Carbon::now('Europe/Rome');
        

        $updatedFlats = $flats->map(function ($flat) use ($currentDate) {
            $flatEndDate = isset($flat->sponsors[0]->pivot->end_date) ? Carbon::parse($flat->sponsors[0]->pivot->end_date, 'Europe/Rome') : Carbon::parse('1900-01-01', 'Europe/Rome');
            
            $flat->sponsored = $currentDate->lt($flatEndDate);
            return $flat;
        });

        

        return response()->json($updatedFlats);
    }

    public function show($slug)
    {

        $flat = Flat::with(['services', 'photos'])->where("slug", $slug)->first();
        return response()->json($flat);
    }
}
