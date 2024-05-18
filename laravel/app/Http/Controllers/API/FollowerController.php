<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

class FollowerController extends Controller
{
    public function index(): HttpJsonResponse
    {
        $count = Auth::user()->followers->count();
        return JsonResponse::success($count, 'Number of followers success', 200);
    }

    public function followerList(): HttpJsonResponse
    {
        return JsonResponse::success(Auth::user()->followers, 'Success: Followers', 200);
    }

    public function store(Request $request): HttpJsonResponse
    {
        $user = Auth::user();

        // Verificar si ya sigue al usuario
        if ($user->followers->where('follower_id', $request->input('follower_id'))->exists()) {
            return JsonResponse::success('ERROR: Already following this user', 400);
        }

        $follower = Follower::create([
            'user_id' => $user->id,
            'follower_id' => $request->input('follower_id'),
        ]);

        return JsonResponse::success($follower, 'Follow success', 200);
    }

    public function destroy(string $id): HttpJsonResponse
    {
        $user = Auth::user();

        $follower = $user->followers->where('follower_id', $id)->first();

        // Verificar si no sigue al usuario
        if (!$follower) {
            return JsonResponse::error('ERROR: You are not following this user', 404);
        }

        $follower->delete();
        return JsonResponse::success($follower, 'Unfollow success', 200);
    }
}
