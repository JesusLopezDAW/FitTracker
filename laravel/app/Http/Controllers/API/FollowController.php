<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;
use Illuminate\Support\Facades\DB;

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
        if ($user->follows()->where('followed_user_id', $id)->exists()) {
            return response()->json(['error' => 'Ya sigues a este usuario'], 400);
        }

        // Seguir al usuario objetivo
        $follow = Follow::create([
            "user_id" => $user->id,
            "followed_user_id" => $followedUser->id,
        ]);
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
        if (!$user->follows()->where('followed_user_id', $id)->exists()) {
            return response()->json(['error' => 'No sigues a este usuario'], 400);
        }

        // Dejar de seguir al usuario objetivo
        $follow = Follow::where('user_id', $user->id)->where('followed_user_id', $followedUser->id);
        $follow->delete();
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
        $count = DB::table('follows')
            ->where('followed_user_id', Auth::id())
            ->count();
        return JsonResponse::success($count, 'Success', 200);
    }

    public function followersNumberOtherUser($id)
    {
        $count = DB::table('follows')
            ->where('followed_user_id', $id)
            ->count();
        return JsonResponse::success($count, 'Success', 200);
    }

    public function followingNumber()
    {
        $count = DB::table('follows')
            ->where('user_id', Auth::id())
            ->count();
        return JsonResponse::success($count, 'Success', 200);
    }

    public function followingNumberOtherUser($id)
    {
        $count = DB::table('follows')
            ->where('user_id', $id)
            ->count();
        return JsonResponse::success($count, 'Success', 200);
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
