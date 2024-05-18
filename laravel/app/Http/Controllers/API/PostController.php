<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(): HttpJsonResponse
    {
        $user = Auth::user();
        dd($user);

        return JsonResponse::success($user->posts, 'success', 200);
    }

    public function store(PostRequest $request): HttpJsonResponse
    {
        $userId = Auth::id();

        // Verificar si el usuario está autenticado
        if (!$userId) {
            return JsonResponse::error('User not authenticated', 401);
        }

        // Obtener el último workout para el usuario
        $workout = $this->getLastWorkoutForUser($userId);

        // Verificar si se encontró un workout
        if (!$workout) {
            return JsonResponse::error('Error: Workout not found for the user', 404);
        }

        // Verificar si hay una imagen en la solicitud
        $imageData = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = base64_encode(file_get_contents($image->path()));
        }

        // Crear un nuevo post con los datos validados
        $post = DB::table('posts')->insertGetId([
            'user_id' => $userId, // Asignar el ID del usuario al campo user_id
            'title' => $request->input('title'),
            'image' => $imageData,
            'workout_id' => $workout, // Asegúrate de obtener el ID del workout
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $post = DB::table('posts')->find($post);

        return JsonResponse::success($post, 'Post created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    private function getLastWorkoutForUser($userId)
    {
        // Encuentra al usuario
        $user = User::findOrFail($userId);

        // Obtén el último log del usuario
        $lastWorkout = DB::select('SELECT workouts.id
        FROM workouts
        JOIN routines ON workouts.routine_id = routines.id
        JOIN users ON routines.user_id = users.id
        WHERE users.id = 1
        order by workouts.created_at
        LIMIT 1;');
        return $lastWorkout[0]->id;
    }
}
