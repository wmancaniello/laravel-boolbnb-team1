<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlatRequest;
use App\Http\Requests\UpdateFlatRequest;
use App\Models\Flat;
use App\Models\Photo;
use App\Models\Service;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Importazione della classe Str

class FlatsController extends Controller
{
    // INDEX
    public function index()
    {
        $flats = Flat::where('user_id', Auth::id())->get();
        return view('admin.flats.index', compact('flats'));
    }

    // CREATE
    public function create()
    {
        $services = Service::all();
        return view('admin.flats.create', compact('services'));
    }

    // STORE
    public function store(StoreFlatRequest $request)
    {
        $newFlat = new Flat();
        $newFlat->fill($request->validated());
        $newFlat->user_id = Auth::id();
        $newFlat->main_img = Storage::put('flats_img', $request->main_img);
        $newFlat->slug = $this->generateUniqueSlug($request->title);
        $newFlat->save();
        $newFlat->services()->attach($request->services);
        if (isset($request->photos[0])) {
            $photos = $request->photos;
            foreach ($photos as $photo) {
                $newPhoto = new Photo();
                $newPhoto->flat_id = $newFlat->id;
                $newPhoto->image = Storage::put('flats_img', $photo);
                $newPhoto->save();
            }
        }
        return redirect()->route('admin.flats.show', $newFlat->slug)->with('success', 'Appartamento aggiunto con successo.');
    }

    // SHOW
    public function show(Flat $flat)
    {
        $sponsors = Sponsor::all();
        if ($flat->user_id === Auth::id()) {
            return view('admin.flats.show', compact('flat', 'sponsors'));
        } else {
            abort(403);
        }
    }

    // EDIT
    public function edit(string $slug)
    {
        $flat = Flat::where('slug', $slug)->firstOrFail();
        if ($flat->user_id === Auth::id()) {
            $services = Service::all();
            $photos = Photo::where('flat_id', $flat->id)->get();
            return view('admin.flats.edit', compact('flat', 'services', 'photos'));
        } else {
            abort(403);
        }
    }

    // UPDATE
    public function update(UpdateFlatRequest $request, string $slug)
    {
        $flat = Flat::where('slug', $slug)->firstOrFail();
        if (Auth::id() === $flat->user_id) {
            $flat->fill($request->validated());

            if ($request->title !== $flat->title) {
                $flat->slug = $this->generateUniqueSlug($request->title, $flat->id);
            }

            if ($request->hasFile('main_img')) {
                if ($flat->main_img) {
                    Storage::delete($flat->main_img);
                }
                $flat->main_img = Storage::put('flats_img', $request->main_img);
            }

            $flat->save();

            if ($request->has('services')) {
                $flat->services()->sync($request->services);
            }

            if (isset($request->photos[0])) {
                $oldImages = Photo::where('flat_id', $flat->id)->get();


                foreach ($oldImages as $oldImage) {
                    Storage::delete($oldImage->image);
                    $oldImage->delete();
                }

                $photos = $request->photos;
                foreach ($photos as $photo) {
                    $newPhoto = new Photo();
                    $newPhoto->flat_id = $flat->id;
                    $newPhoto->image = Storage::put('flats_img', $photo);
                    $newPhoto->save();
                }
            }

            return redirect()->route('admin.flats.show', $flat->slug)->with('success', 'Appartamento modificato con successo.');
        } else {
            abort(403);
        }
    }

    // DESTROY
    public function destroy(string $slug)
    {
        $flat = Flat::where('slug', $slug)->firstOrFail();
        if (Auth::id() === $flat->user_id) {
            // Elimino relazione N:N
            $flat->sponsors()->detach();
            $flat->services()->detach();
            // Check immagine
            if ($flat->main_img) {
                Storage::delete($flat->main_img);
            }
            $flat->delete();
            return redirect()->route('admin.flats.index')->with('success', 'Appartamento : ' . $flat->title . ' è stato rimosso con successo.');
        } else {
            abort(403);
        }
    }

    // ----------------- FUNC ------------------------
    private function generateUniqueSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;
        while (Flat::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        return $slug;
    }
}
