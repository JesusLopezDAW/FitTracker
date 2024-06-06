<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

class FollowController extends Controller
{
    public function follow(string $id)
    {
        $user = Auth::user();

        // Verificar si el usuario a seguir existe
        $followedUser = User::find($id);

        if (!$followedUser) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Verificar si el usuario ya sigue al usuario objetivo
        if ($user->following()->where('followed_id', $id)->exists()) {
            return response()->json(['error' => 'Ya sigues a este usuario'], 400);
        }

        // Seguir al usuario objetivo
        $user->following()->attach($id);
        return JsonResponse::success('Follow success', 200);
    }

    public function unfollow(string $id)
    {
        $user = Auth::user();
        $followedUser = User::find($id);
        if (!$followedUser) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Verificar si el usuario ya sigue al usuario objetivo
        if (!$user->following()->where('followed_id', $id)->exists()) {
            return response()->json(['error' => 'No sigues a este usuario'], 400);
        }

        // Dejar de seguir al usuario objetivo
        $user->following()->detach($id);
        return JsonResponse::success('Unfollow success', 201);
    }

    public function followers()
    {
        return JsonResponse::success(Auth::user()->followers->select('id', 'name', 'profile_photo_path'), 'Success', 200);
    }

    public function following()
    {
        return JsonResponse::success(Auth::user()->follows->select('id', 'name', 'profile_photo_path'), 'Success', 200);
    }

    public function followersNumber()
    {
        return JsonResponse::success(Auth::user()->followers->count(), 'Success', 200);
    }

    public function followersNumberOtherUser($id)
    {
        return JsonResponse::success(User::find($id)->followers()->count(), 'Success', 200);
    }

    public function followingNumber()
    {
        return JsonResponse::success(Auth::user()->following->count(), 'Success', 200);
    }

    public function followingNumberOtherUser($id)
    {
        return JsonResponse::success(User::find($id)->following()->count(), 'Success', 200);
    }

    public function followUser($id)
    {
        $followUser = User::find($id);
        if (!$followUser) {
            return JsonResponse::error('ERROR: User not found', 404);
        }

        $user = Auth::user();

        if ($user->id == $id) {
            return JsonResponse::error('ERROR: Can not follow you', 401);
        }

        $data = $user->follows->contains($followUser->id) ? true : false;

        return JsonResponse::success($data, 'Success', 200);
    }
}
