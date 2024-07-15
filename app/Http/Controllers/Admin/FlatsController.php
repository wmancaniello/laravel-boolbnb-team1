<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlatRequest;
use App\Http\Requests\UpdateFlatRequest;
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
    public function edit(string $slug)
    {
        $flat = Flat::where('slug', $slug)->firstOrFail();
        return view('admin.flats.edit', compact('flat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFlatRequest $request, string $slug)
    {
        $flat = Flat::where('slug', $slug)->firstOrFail();
        $flat->fill($request->validated());
        if (Auth::id() === $flat->user_id) {

            if ($request->hasFile('main_img')) {
                if ($flat->main_img) {
                    Storage::delete($flat->main_img);
                }
                $flat->main_img = Storage::put('flats_img', $request->main_img);
            }

            $flat->save();

            return redirect()->route('admin.flats.show', $flat->slug)->with('success', 'Appartamento modificato con successo.');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $flat = Flat::where('slug', $slug)->firstOrFail();;
        if(Auth::id() === $flat->user_id){
            // Elimino relazione N:N
            $flat->sponsors()->detach();
            $flat->services()->detach();
            // Check immagine
            if ($flat->main_img) {
                Storage::delete($flat->main_img);
            }
            $flat->delete();
            return redirect()->route('admin.flats.index')->with('message', 'Appartamento : ' . $flat->title . ' è stato rimosso con successo.');
        } else {
            abort(403);
        }
    }
}
