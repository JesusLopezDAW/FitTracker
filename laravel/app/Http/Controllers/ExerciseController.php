<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        $visibility = User::find($userId)->isAdmin() ? 'global' : 'user';

        $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:cardio,olympic_weightlifting,plyometrics,powerlifting,strength,stretching,strongman',
            'muscle' => 'nullable|in:abdominals,abductors,adductors,biceps,calves,chest,forearms,glutes,hamstrings,lats,lower_back,middle_back,neck,quadriceps,traps,triceps|string',
            'equipment' => 'nullable|string',
            'difficulty' => 'nullable|string|in:beginner,intermediate,expert',
            'instructions' => 'required|string'
        ]);

        $validatedData['user_id'] = $userId;
        $validatedData['visibility'] = $visibility;
        $validatedData['extra_info'] = "Creado desde el panel de administracion";

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images/exercises');
            $imageFullPath = storage_path('app/' . $imagePath);
            $imageBinary = file_get_contents($imageFullPath);
            $imagenBase64 = base64_encode($imageBinary);
            $imagenDataURL = "data:image/jpeg;base64," . $imagenBase64;
            $validatedData['image'] = $imagenDataURL;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('public/videos/exercises');
            $videoFullPath = storage_path('app/' . $videoPath);
            $videoBinary = file_get_contents($videoFullPath);
            $videoBase64 = base64_encode($videoBinary);
            $videoDataURL = "data:video/mp4;base64," . $videoBase64;
            $validatedData['video'] = $videoDataURL;
        }

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

        $exercise = Exercise::find($request->id);

        if (!$exercise) {
            return response()->json(['error' => 'No se encontró el alimento'], 404);
        }

        $exercise->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'muscle' => $request->input('muscle'),
            'equipment' => $request->input('equipment'),
            'difficulty' => $request->input('difficulty'),
            'instructions' => $request->input('instructions'),
            'visibility' => $request->input('visibility')
        ]);

        $exercise->save();

        return response()->json(['message' => 'Ejercicio actualizado correctamente'], 200);
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
