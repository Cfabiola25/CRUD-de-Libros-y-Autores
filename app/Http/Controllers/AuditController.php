<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    /**
     * Muestra la lista de auditorías registradas.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Audit::query();

        // Filtro por usuario
        if ($request->filled('user')) {
            $query->where('user_id', $request->user);
        }

        // Filtro por tipo de evento (created, updated, deleted)
        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }

        // Obtener los resultados con relación al usuario, ordenados y paginados
        $audits = $query->with('user')->latest()->paginate(10);

        // Retornar a la vista
        return view('audits.index', compact('audits'));
    }
}
