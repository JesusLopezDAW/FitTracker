<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises = Exercise::where('visibility', 'user')->get();
        return view('admin.suggestion.exercises', compact('exercises'));
    }

    public function store(Exercise $exercise)
    {

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
    public function update(Exercise $exercise)
    {
        $exercise->update(['visibility' => 'global']);
        return response()->json(['message' => 'Visibilidad cambiada correctamente'], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exercise = Exercise::find($id);
        if ($exercise) {
            $exercise->delete();
            // Recupera los datos actualizados después de eliminar el ejercicio
            $exercises = Exercise::where('visibility', 'user')->get();
            // Devuelve una respuesta de éxito junto con los datos actualizados
            return response()->json(['message' => 'Ejercicio eliminado correctamente', 'data' => $exercises], 200);
        } else {
            // Devuelve una respuesta de error si el ejercicio no se encuentra
            return response()->json(['message' => 'No se encontró el ejercicio'], 404);
        }
    }
}
