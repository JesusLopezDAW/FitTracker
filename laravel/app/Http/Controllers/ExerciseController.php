<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['message' => 'El usuario no existe']);
        }

        $visibility = User::find($userId)->isAdmin() ? 'global' : 'user';

        $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:cardio,olympic_weightlifting,plyometrics,powerlifting,strength,stretching,strongman',
            'muscle' => 'nullable|in:abdominals,abductors,adductors,biceps,calves,chest,forearms,glutes,hamstrings,lats,lower_back,middle_back,neck,quadriceps,traps,triceps',
            'equipment' => 'nullable|string',
            'difficulty' => 'nullable|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image',
            'video' => 'nullable|string',
        ]);

        $validatedData['user_id'] = $userId;
        $validatedData['visibility'] = $visibility;

        $exercise = Exercise::create($validatedData);

        return response()->json(['message' => 'Ejercicio creado correctamente', 'exercise' => $exercise], 201);
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
        $exercise = Exercise::find($id);
        if ($exercise) {
            $exercise->delete();
            // Recupera los datos actualizados después de eliminar el ejercicio
            $exercises = Exercise::all();
            // Devuelve una respuesta de éxito junto con los datos actualizados
            return response()->json(['message' => 'Ejercicio eliminado correctamente', 'data' => $exercises], 200);
        } else {
            // Devuelve una respuesta de error si el ejercicio no se encuentra
            return response()->json(['message' => 'No se encontró el ejercicio'], 404);
        }
    }
}
