<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patologia;
use App\Models\Familia;
use App\Models\User;
use App\Models\Manzana;
use App\Models\FichaFamiliar;
use App\Models\Integrante;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = [
            'familias' => Familia::count(),
            'usuarios' => User::count(),
            'sectores' => Manzana::count(),
            'fichas' => FichaFamiliar::count(),
            'integrantes' => Integrante::count(),
            'nuevas_familias_mes' => Familia::whereMonth('created_at', now()->month)->count(),
            'nuevas_fichas_hoy' => FichaFamiliar::whereDate('created_at', now()->today())->count(),
        ];

        // Fetch Pathology Types and their record counts
        $patologias = \App\Models\TipoPatologia::withCount(['campos'])->get()->map(function($tipo) {
            // Count records dynamically from the table defined in TipoPatologia
            try {
                $count = \DB::table($tipo->tabla_datos)->count();
            } catch (\Exception $e) {
                $count = 0;
            }
            $tipo->registros_count = $count;
            return $tipo;
        });

        // Real Recent Activity from multiple sources
        $recent_families = Familia::latest()->take(3)->get()->map(function($f) {
            return [
                'type' => 'familia',
                'title' => "Nueva familia: {$f->apellidos}",
                'time' => $f->created_at->diffForHumans(),
                'icon' => 'bg-indigo-500',
                'description' => "Familia registrada en el sistema",
                'url' => route('familias.show', $f->id)
            ];
        });

        $recent_fichas = FichaFamiliar::latest()->take(3)->get()->map(function($f) {
            return [
                'type' => 'ficha',
                'title' => "Ficha Médica: {$f->codigo}",
                'time' => $f->created_at->diffForHumans(),
                'icon' => 'bg-emerald-500',
                'description' => "Ficha familiar actualizada",
                'url' => route('familias.show', $f->familia_id) // Link to family since ficha show might not be primary
            ];
        });

        $recent_users = User::latest()->take(2)->get()->map(function($u) {
            return [
                'type' => 'usuario',
                'title' => "Nuevo usuario: {$u->name}",
                'time' => $u->created_at->diffForHumans(),
                'icon' => 'bg-slate-500',
                'description' => $u->getRoleName(),
                'url' => route('users.show', $u->id)
            ];
        });

        $activities = $recent_families->concat($recent_fichas)->concat($recent_users)
            ->sortByDesc(function($item) {
                // Parse the diffForHumans string back to a verifiable sortable value if possible, 
                // but since these are collections from DB, better to merge collections before mapping if we want strict time sorting.
                // For simplicity here, we assume 'latest()' query does the job roughly, but inter-model sorting is tricky without timestamps.
                // Let's just shuffle mixed or keep as is. Ideally we should have queried timestamps.
                return 0; 
            })->values()->take(10); 
            // Better sorting approach:
            
        $activities = collect();
        $activities = $activities->concat(Familia::latest()->take(5)->get()->map(fn($m) => ['date' => $m->created_at, 'data' => $m, 'type' => 'familia']));
        $activities = $activities->concat(FichaFamiliar::latest()->take(5)->get()->map(fn($m) => ['date' => $m->created_at, 'data' => $m, 'type' => 'ficha']));
        
        $activities = $activities->sortByDesc('date')->take(6)->map(function($item) {
            if ($item['type'] == 'familia') {
                return [
                    'icon' => 'bg-indigo-500',
                    'title' => "Nueva familia: " . $item['data']->apellidos,
                    'time' => $item['data']->created_at->diffForHumans(),
                ];
            } else {
                return [
                    'icon' => 'bg-emerald-500',
                    'title' => "Ficha registrada: " . $item['data']->codigo,
                    'time' => $item['data']->created_at->diffForHumans(),
                ];
            }
        });

        // User specific stats
        $user_stats = [
            'familias_creadas' => Familia::count(), 
            'fichas_creadas' => FichaFamiliar::count(),
        ];
        
        return view('home', compact('stats', 'patologias', 'activities', 'user_stats'));
    }
}
