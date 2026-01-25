<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patologia;
use App\Models\Familia;
use App\Models\User;
use App\Models\Sector;
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
            'sectores' => Sector::count(),
            'fichas' => FichaFamiliar::count(),
            'integrantes' => Integrante::count(),
            'nuevas_familias_mes' => Familia::whereMonth('created_at', now()->month)->count(),
            'nuevas_fichas_hoy' => FichaFamiliar::whereDate('created_at', now()->today())->count(),
        ];

        $patologias = Patologia::all();

        // Real Recent Activity
        $recent_families = Familia::latest()->take(3)->get()->map(function($f) {
            return [
                'type' => 'familia',
                'title' => "Nueva familia registrada: {$f->apellidos}",
                'time' => $f->created_at->diffForHumans(),
                'icon' => 'theme-bg'
            ];
        });

        $recent_users = User::latest()->take(2)->get()->map(function($u) {
            return [
                'type' => 'usuario',
                'title' => "Usuario registrado: {$u->name}",
                'time' => $u->created_at->diffForHumans(),
                'icon' => 'bg-sky-500'
            ];
        });

        $activities = $recent_families->concat($recent_users)->sortByDesc('time')->take(5);

        // User specific stats
        $user_stats = [
            'familias_creadas' => Familia::count(), // Simplified since I don't see a created_by column in your migration
            'fichas_creadas' => FichaFamiliar::count(),
        ];
        
        return view('home', compact('stats', 'patologias', 'activities', 'user_stats'));
    }
}
