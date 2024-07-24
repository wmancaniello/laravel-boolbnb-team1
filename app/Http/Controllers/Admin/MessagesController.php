<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $datas = Message::whereHas('flat', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
        $selectedMessage = null;

        if ($request->has('selected_id')) {
            $selectedMessage = Message::with('flat')->find($request->input('selected_id'));
        }

        return view('admin.messages.index', compact('datas', 'selectedMessage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validazione
        $validatedData = $request->validate([
            'flatId' => 'required|exists:flats,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'text' => 'required|string',
        ]);

        // Nuovo Messaggio
        $message = Message::create([
            'flat_id' => $validatedData['flatId'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'text' => $validatedData['text'],
        ]);

        return response()->json(['message' => 'Messaggio inviato correttamente', 'data' => $message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Message::with('flat')->find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found.'], 404);
        }

        return response()->json($message);
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
        $message = Message::find($id);

        if (!$message) {
            return redirect()->route('admin.messages.index')->with('error', 'Messaggio non trovato.');
        }

        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Messaggio eliminato con successo.');
    }

    // Notifica
    public function markAsRead($id)
    {
        $message = Message::find($id);
        if ($message) {
            $message->is_read = 1;
            $message->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
