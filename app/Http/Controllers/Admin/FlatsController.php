<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlatRequest;
use App\Models\Flat;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FlatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.flats.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlatRequest $request)
    {
        $newFlat = new Flat();
        $newFlat->fill($request->validated());
        $newFlat->user_id = Auth::id();
        $newFlat->main_img = Storage::put('flats_img', $request->main_img);
        $newFlat->save();
        $newFlat->services()->attach($request->services);
        return redirect()->route('admin.flats.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flat $flat)
    {
        return view('admin.flats.show', compact('flat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
