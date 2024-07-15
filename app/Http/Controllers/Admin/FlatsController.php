<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlatRequest;
use App\Models\Flat;
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
        return view('admin.flats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlatRequest $request)
    {
        $newFlat = new Flat();
        $newFlat->fill($request->validated());
        $newFlat->user_id = Auth::id();
        $newFlat->main_img = Storage::put('flats_main', $request->main_img);
        $newFlat->save();
        return redirect()->route('admin.flats.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $flat = Flat::findOrFail($id);
        if(Auth::id() === $flat->user_id){
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
