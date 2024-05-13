<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LikeController extends Controller
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
        //
    }

    public function getLikesByPeriod($period)
    {
        // Obtener la fecha de inicio según el período seleccionado
        $startDate = $this->getStartDate($period);

        // Obtener los ejercicios creados desde la fecha de inicio hasta ahora
        $likes = Like::where('created_at', '>=', $startDate)->get();

        // Devolver los ejercicios como respuesta JSON
        return response()->json($likes);
    }

    private function getStartDate($period)
    {
        // Calcular la fecha de inicio según el período seleccionado
        switch ($period) {
            case 'hoy':
                return Carbon::now()->startOfDay();
            case 'ultima_semana':
                return Carbon::now()->subWeek()->startOfDay();
            case 'ultimo_mes':
                return Carbon::now()->subMonth()->startOfDay();
            case 'ultimos_3_meses':
                return Carbon::now()->subMonths(3)->startOfDay();
            case 'ultimos_6_meses':
                return Carbon::now()->subMonths(6)->startOfDay();
            case 'ultimo_ano':
                return Carbon::now()->subYear()->startOfDay();
            case 'global':
            default:
                return Carbon::now()->startOfDay();
        }
    }

}
