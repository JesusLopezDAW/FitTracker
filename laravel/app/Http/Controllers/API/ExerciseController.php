<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseRequest;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

class ExerciseController extends Controller
{
    public function index(): HttpJsonResponse
    {
        $user = Auth::user();

        // Obtener los ejercicios globales y del usuario
        $globalExercises = Exercise::where('visibility', 'global')->get()->groupBy('muscle');
        $userExercises = Exercise::where('visibility', 'user')
            ->where('user_id', $user->id)
            ->get()
            ->groupBy('muscle');

        $exercises = [
            "globals" => $globalExercises,
            "user" => $userExercises
        ];

        return response()->json(['data' => $exercises, 'message' => 'success'], 200);
    }

    public function store(ExerciseRequest $request): HttpJsonResponse
    {
        $userId = Auth::id();
        $visibility = User::find($userId)->isAdmin() ? 'user' : 'user';

        $data = $request->validated();
        $data['user_id'] = $userId;
        $data['visibility'] = $visibility;
        $data['extra_info'] = "Creado desde el panel de administracion";

        if ($request->input('image')) {
            $data['image'] = $request->input('image');
        }
        
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('public/videos/exercises');
            $data['video'] = $videoPath;
        }
        
        $exercise = Exercise::create($data);

        return JsonResponse::success($exercise, 'Store success', 201);
    }

    public function show(string $id): HttpJsonResponse
    {
        $userId = Auth::id();

        $exercise = Exercise::find($id);

        $this->validateExist($exercise);
        $this->isFromUser($exercise, $userId);

        return JsonResponse::success($exercise, 'Success', 200);
    }

    public function update(ExerciseRequest $request, string $id): HttpJsonResponse
    {
        $userId = Auth::id();
        $exercise = Exercise::find($id);

        $this->validateExist($exercise);
        $this->isFromUser($exercise, $userId);

        $exercise->update($request->all());

        return JsonResponse::success($exercise, 'Update success', 200);
    }

    public function destroy(string $id): HttpJsonResponse
    {
        $userId = Auth::id();

        $exercise = Exercise::find($id);

        $this->validateExist($exercise);
        $this->isFromUser($exercise, $userId);

        $exercise->delete();

        return JsonResponse::success($exercise, 'Delete success', 200);
    }

    private function validateExist(Exercise | string $exercise)
    {
        if (!$exercise) {
            return JsonResponse::error('Error: This exercise do not exist', 400);
        }
    }

    private function isFromUser(Exercise $exercise, int $userId)
    {
        if ($exercise->visibility != 'global' && $exercise->user_id != $userId) {
            return JsonResponse::error('Error: This exercise is not from this user', 401);
        }
    }

    public function search(Request $request)
    {
        // Validar que el parámetro 'search' esté presente
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Obtener el parámetro de búsqueda
        $search = $request->input('query');

        // Realizar la búsqueda utilizando Algolia a través de Scout
        $exercises = Exercise::search($search)->paginate(10);

        return JsonResponse::success($exercises, 'Success', 200);
    }

    public function showAllExercises(): HttpJsonResponse
    {
        $user = Auth::user();

        // Obtener los ejercicios globales y del usuario
        $exercises = Exercise::where('visibility', 'global')
            ->orWhere(function ($query) use ($user) {
                $query->where('visibility', 'user')
                    ->where('user_id', $user->id);
            })->paginate(40);

        return response()->json(['exercises' => $exercises, 'message' => 'success'], 200);
    }
}
