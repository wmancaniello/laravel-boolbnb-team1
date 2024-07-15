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
        $datas = Message::whereHas('flat', function($query) use($userId) {
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
        //
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
        //
    }
}
