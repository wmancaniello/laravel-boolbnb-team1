<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flat;
use App\Models\Service;

class FlatController extends Controller
{
    public function index(Request $request)
    {      
            $serviceIds = $request->services;
            $minBeds = $request->beds;
            $minRooms = $request->rooms;
            
            $flats = Flat::query()
            ->visibleFlats()
            ->minBeds($minBeds)
            ->minRooms($minRooms)
            ->when(!empty($serviceIds), function ($query) use ($serviceIds) {
                return $query->withAllServices($serviceIds);
            })
            ->orderBy('beds', 'asc')
            ->get();

        return response()->json($flats);
    }

    public function show($slug) {

        $flat = Flat::with(['services', 'photos'])->where("slug", $slug )->first();
        return response()->json($flat);
    }
}
