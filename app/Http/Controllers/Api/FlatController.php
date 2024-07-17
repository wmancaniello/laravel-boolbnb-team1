<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flat;

class FlatController extends Controller
{
    public function index()
    {
        $flats = Flat::all();
        return response()->json($flats);
    }
}
