<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

class LikeController extends Controller
{
    public function index(): HttpJsonResponse
    {
        return JsonResponse::success(Auth::user()->likes, 'success', 200);
    }

    public function show(string $postId): HttpJsonResponse
    {
        $post = Post::find($postId);
        if(!$post){
            return JsonResponse::error('ERROR: Post doesnt exist', 404);
        }
        $likes = $post->likes->count();

        return JsonResponse::success($likes, 'success', 200);

    }

    public function usersLikePost(string $postId): HttpJsonResponse
    {
        $post = Post::find($postId);
        if(!$post){
            return JsonResponse::error('ERROR: Post doesnt exist', 404);
        }
        $likes = $post->likes;

        // Obtener los datos de los usuarios que dieron like
        $users = $likes->map(function($like) {
            return [
                'id' => $like->user->id,
                'name' => $like->user->name,
                'image' => $like->user->image
            ];
        });


        return JsonResponse::success($users, 'success', 200);
    }

    public function store(LikeRequest $request): HttpJsonResponse
    {
        $user = Auth::user();

        $like = Like::where('user_id', $user->id)->where('post_id', $request->post_id)->first();

        if($like){
            return response()->json(['error' => 'You alredy liked this post'], 400);
        }

        $like = Like::create([
            'post_id' => $request->post_id,
            'user_id' => $user->id,
        ]);
        return JsonResponse::success($like, 'Liked successfuly', 200);
    }

    public function destroy(string $postId)
    {
        $user = Auth::user();

        // Buscar el like asociado al post y al usuario autenticado
        $like = Like::where('user_id', $user->id)->where('post_id', $postId)->first();

        // Verificar que el like existe y pertenece al usuario autenticado
        if (!$like) {
            return response()->json(['error' => 'Like not found'], 404);
        }

        $like->delete();
        return JsonResponse::success($like, 'like removed successfuly', 200);
    }
}
