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
        $flats = Flat::with('services')->get();
        return response()->json($flats);
    }
}
