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
        // Messaggi contati e filtrati per mese, dove vengono selezionati quelli ricevuti dal proprietario corrispondente
        $messages = Message::select(DB::raw('COUNT(*) as count'), DB::raw('MONTH(created_at) as month'))
            ->whereIn('flat_id', function ($query) use ($ownerId) {
                $query->select('id')
                    ->from('flats')
                    ->where('user_id', $ownerId);
            })
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $labels = [];
        $values = [];
        // Per ogni mese, labels e values
        for ($month = 1; $month <= 12; $month++) {
            $labels[] = Carbon::create()->month($month)->format('F');
            $values[] = $messages->get($month)->count ?? 0;
        }
        return view('admin.dashboard', compact('labels', 'values'));
    }
}
