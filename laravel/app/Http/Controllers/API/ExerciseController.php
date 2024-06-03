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

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images/exercises');
            $imageFullPath = storage_path('app/' . $imagePath);
            $imageBinary = file_get_contents($imageFullPath);
            $imagenBase64 = base64_encode($imageBinary);
            $imagenDataURL = "data:image/jpeg;base64," . $imagenBase64;
            $data['image'] = $imagenDataURL;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('public/videos/exercises');
            $videoFullPath = storage_path('app/' . $videoPath);
            $videoBinary = file_get_contents($videoFullPath);
            $videoBase64 = base64_encode($videoBinary);
            $videoDataURL = "data:video/mp4;base64," . $videoBase64;
            $data['video'] = $videoDataURL;
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

    private function isFromUser(Exercise $exercise, int $userId){
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
}
