<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(): HttpJsonResponse
    {
        return JsonResponse::success(Auth::user()->posts, 'success', 200);
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

    public function show(string $id): HttpJsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return JsonResponse::error('Error: This post do not exist', 400);
        }

        return JsonResponse::success($post, 'Success', 200);
    }

    public function update(PostRequest $request, string $id)
    {
        $userId = Auth::id();

        $post = Post::find($id);

        if (!$post) {
            return JsonResponse::error('Error: This post do not exist', 404);
        }

        $user = $post->user;
        // Verificar si el usuario es el propietario del post
        if ($user->id !== $userId) {
            return JsonResponse::error('Error: You are not authorized to update this post', 403);
        }

        $post->update($request->all());

        return JsonResponse::success($post, 'Update success', 200);
    }

    public function destroy(string $id): HttpJsonResponse
    {
        $userId = Auth::id();

        $post = Post::find($id);

        if (!$post) {
            return JsonResponse::error('Error: This post do not exist', 400);
        }
        // TODO: move functions
        $user = $post->user;
        if ($user->id !== $userId) {
            return JsonResponse::error('Error: You are not authorized to update this post', 403);
        }

        $post->delete();

        return JsonResponse::success($post, 'Delete success', 200);
    }

    public function getFollowedPosts()
    {
        $user = Auth::user();
        $followedUserIds = $user->followings->pluck('id');

        $posts = Post::with(['user:id,name,profile_photo_path'])
            ->whereIn('user_id', $followedUserIds)
            ->orderBy('created_at', 'desc')
            ->withCount('likes')
            ->withCount('comments')
            ->paginate(10);

        return JsonResponse::success($posts, 'Success', 200);
    }

    public function getInterestingPosts()
    {
        $posts = Post::with(['user:id,name,profile_photo_path'])
        ->withCount('likes')
        ->withCount('comments')
        ->orderBy('likes_count', 'desc')
        ->paginate(10);

        

        return JsonResponse::success($posts, 'Success', 200);
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

    private function verifyWorkout($workout)
    {
        if (!$workout) {
            return JsonResponse::error('Error: Workout not found for the user', 404);
        }
    }
}
