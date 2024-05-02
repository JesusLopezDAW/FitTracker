<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises = Exercise::all();
        return view('admin.exercises', compact('exercises'));
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
    public function update(Request $request)
    {
        $id = $request->input('id');
        $exercise = Exercise::find($id);

        $exercise->name = $request->input('name');
        $exercise->type = $request->input('type');
        $exercise->muscle = $request->input('muscle');
        $exercise->equipment = $request->input('equipment');
        $exercise->difficulty = $request->input('difficulty');
        $exercise->instructions = $request->input('instructions');

        $exercise->save();

        return "success";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exc = Exercise::find($id);
        if ($exc) {
            $exc->delete();
            // Devuelve una respuesta de éxito
            return response()->json(['message' => 'Ejercicio eliminado correctamente'], 200);
        } else {
            // Devuelve una respuesta de error si el ejercicio no se encuentra
            return response()->json(['message' => 'No se encontró el ejercicio'], 404);
        }
    }
}
