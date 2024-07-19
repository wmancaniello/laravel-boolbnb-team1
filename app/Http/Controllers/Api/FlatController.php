<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flat;
use App\Models\Service;

class FlatController extends Controller
{
    public function index()
    {
        $flats = Flat::with('services')->where("visible", "1")->get();
        return response()->json($flats);
    }

    public function show($slug) {

        $flat = Flat::with(['services', 'photos'])->where("slug", $slug )->first();
        return response()->json($flat);
    }
}
