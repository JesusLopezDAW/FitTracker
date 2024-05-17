<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
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
        $user = Auth::user();

        $globalExercises = Exercise::where('visibility', 'global')->get();

        $userExercises = Exercise::where('visibility', 'user')
            ->where('user_id', $user->id)
            ->get();

        $exercises = [
            "globals" => $globalExercises,
            "user" => $userExercises
        ];

        return JsonResponse::success($exercises, 'success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    // TODO: ExerciseRequest
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

        return JsonResponse::success($exercise, 'Store success', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userId = Auth::id();

        $exercise = Exercise::find($id);

        if (!$exercise) {
            return JsonResponse::error('Error: This exercise do not exist', 400);
        }

        if ($exercise->visibility != 'global' && $exercise->user_id != $userId) {
            return JsonResponse::error('Error: This exercise is not from this user', 401);
        }

        return JsonResponse::success($exercise, 'Success', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return JsonResponse::error('Error: This exercise do not exist', 400);
        }

        $exercise->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'muscle' => $request->input('muscle'),
            'equipment' => $request->input('equipment'),
            'difficulty' => $request->input('difficulty'),
            'instructions' => $request->input('instructions'),
        ]);

        $exercise->save();

        return JsonResponse::success($exercise, 'Update success', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return JsonResponse::error('Error: This exercise do not exist', 400);
        }

        $exercise->delete();

        return JsonResponse::success($exercise, 'Delete success', 200);
    }

    // TODO: funcion exists
    private function validateExist(Exercise $exercise)
    {
        if (!$exercise) {
            return JsonResponse::error('Error: This exercise do not exist', 400);
        }
    }
}
