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
        $userId = Auth::id(); // Obtener el ID del usuario autenticado

        // Consulta para obtener los posts con el número de likes, comentarios y el campo liked
        $posts = Auth::user()->posts()
            ->withCount('likes')
            ->withCount('comments')
            ->with(['likes' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->get();
        $posts->each(function ($post) use ($userId) {
            $post->liked = $post->likes->where('user_id', $userId)->count() > 0;
        });

        return JsonResponse::success($posts, 'success', 200);
    }

    public function userPosts($id): HttpJsonResponse
    {
        $userId = Auth::id(); // Obtener el ID del usuario autenticado

        // Consulta para obtener los posts con el número de likes, comentarios y el campo liked
        $posts = User::find($id)->posts()
            ->withCount('likes')
            ->withCount('comments')
            ->with(['likes' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->get();

        $posts->each(function ($post) use ($userId) {
            $post->liked = $post->likes->where('user_id', $userId)->count() > 0;
        });

        return JsonResponse::success($posts, 'success', 200);
    }

    public function store(PostRequest $request): HttpJsonResponse
    {
        $userId = Auth::id();

        // Verificar si el usuario está autenticado
        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Verificar si hay una imagen en la solicitud
        $imageData = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = base64_encode(file_get_contents($image->path()));
        }

        // Crear un nuevo post con los datos validados
        $post = Post::create([
            'user_id' => $userId, // Asignar el ID del usuario al campo user_id
            'title' => $request->input('title'),
            'image' => $imageData,
            'workout_id' => $request->input('workout_id'), // Asegúrate de obtener el ID del workout
        ]);

        return response()->json(['success' => true, 'data' => $post, 'message' => 'Post created successfully'], 201);
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

    public function getFollowedPosts(): HttpJsonResponse
    {
        $user = Auth::user();
        if ($user->follows === null) {
            return JsonResponse::success([], 'No followed users', 200);
        }
        $followedUserIds = $user->follows->pluck('id');

        $posts = Post::with(['user:id,name,profile_photo_path'])
            ->whereIn('user_id', $followedUserIds)
            ->orderBy('created_at', 'desc')
            ->withCount('likes')
            ->withCount('comments')
            ->paginate(10);

        $userId = $user->id;
        $posts->each(function ($post) use ($userId) {
            $post->liked_by_user = $post->likes->where('user_id', $userId)->count() > 0;
        });
        return JsonResponse::success($posts, 'Success', 200);
    }

    public function getInterestingPosts(): HttpJsonResponse
    {
        $posts = Post::with(['user:id,name,profile_photo_path'])
            ->withCount('likes')
            ->withCount('comments')
            ->orderBy('likes_count', 'desc')
            ->paginate(10);

        $userId = Auth::id();
        $posts->each(function ($post) use ($userId) {
            $post->liked_by_user = $post->likes->where('user_id', $userId)->count() > 0;
        });

        return JsonResponse::success($posts, 'Success', 200);
    }

    public function postCount(): HttpJsonResponse
    {
        $posts = Auth::user()->posts()->count();
        return JsonResponse::success($posts, 'Success', 200);
    }

    public function postCountByUser($id): HttpJsonResponse
    {
        $posts = User::find($id)->posts()->count();
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

    private function isLiked()
    {
    }

    public function newPost(PostRequest $request): HttpJsonResponse
    {
        $userId = Auth::id();

        // Verificar si el usuario está autenticado
        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Verificar si hay una imagen en la solicitud
        $imageData = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = base64_encode(file_get_contents($image->path()));
        }

        // Crear un nuevo post con los datos validados
        $post = Post::create([
            'user_id' => $userId, // Asignar el ID del usuario al campo user_id
            'title' => $request->input('title'),
            'image' => $imageData,
            'workout_id' => $request->input('workout_id'), // Asegúrate de obtener el ID del workout
        ]);

        return response()->json(['success' => true, 'data' => $post, 'message' => 'Post created successfully'], 201);
    }
}
