<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Message;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {   
        if(Auth::id()) {
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
        } else {

            return view('auth.login');
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
