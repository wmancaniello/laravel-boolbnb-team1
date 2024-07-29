<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Id proprietario di casa
        $ownerId = auth()->user()->id;

        // Mese attuale
        $currentMonth = Carbon::now()->endOfMonth();
        $monthNum = $currentMonth->month;

        // Mese attuale dell'anno passato
        $lastYearcurMonth = Carbon::now()->subYear()->month($monthNum)->startOfMonth();

        // Messaggi contati e filtrati per mese e anno
        $messages = Message::whereIn('flat_id', function ($query) use ($ownerId) {
                $query->select('id')
                    ->from('flats')
                    ->where('user_id', $ownerId);
            })
            ->whereBetween('created_at', [$lastYearcurMonth, $currentMonth])
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m');
            });

        $labels = [];
        $values = [];
        $messageData = [];

        // Creare i dati dei messaggi raggruppati per anno e mese
        foreach ($messages as $key => $groupedMessages) {
            $messageData[$key] = $groupedMessages->count();
        }

        // Iterazione sui mesi dall'anno scorso fino al mese attuale
        while ($lastYearcurMonth <= $currentMonth) {
            $labels[] = $lastYearcurMonth->locale('it')->translatedFormat('F Y');
            $key = $lastYearcurMonth->format('Y-m');
            $values[] = $messageData[$key] ?? 0;
            $lastYearcurMonth->addMonth();
        }

        return view('admin.dashboard', compact('labels', 'values'));
    }
}
