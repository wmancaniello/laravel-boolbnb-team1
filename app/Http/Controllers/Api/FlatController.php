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
        // dd($request);
        $serviceIds = $request->services ? json_decode($request->services, true) : [];
        $minBeds = $request->beds;
        $minRooms = $request->rooms;
        $minRad = $request->radius ? $request->radius : 20;
        
        // dd($serviceIds);

        $per_page = 99;
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
            ->paginate($per_page)
            ->appends([
                'beds' => $minBeds,
                'rooms' => $minRooms,
                'services' => json_encode($serviceIds),
                'per_page' => $per_page
            ]);;


        $currentDate = Carbon::now('Europe/Rome');

        


        $flats->getCollection()->transform(function ($flat) use ($currentDate) {
            $flatEndDate = isset($flat->sponsors[0]->pivot->end_date) ? Carbon::parse($flat->sponsors[0]->pivot->end_date, 'Europe/Rome') : Carbon::parse('1900-01-01', 'Europe/Rome');
            $flat->sponsored = $currentDate->lt($flatEndDate);
            return $flat;
        });
        
        return response()->json($flats);
    }

    public function show($slug)
    {

        $flat = Flat::with(['services', 'photos'])->where("slug", $slug)->first();
        return response()->json($flat);
    }
}
