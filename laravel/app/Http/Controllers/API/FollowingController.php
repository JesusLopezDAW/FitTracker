<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\FollowingRequest;
use App\Models\Following;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

class FollowingController extends Controller
{
    public function index(): HttpJsonResponse
    {
        $count = Auth::user()->followedUsers->count();
        return JsonResponse::success($count, 'Number of following success', 200);
    }

    public function followingList(): HttpJsonResponse
    {
        return JsonResponse::success(Auth::user()->followedUsers, 'Success: following', 200);
    }

    public function store(FollowingRequest $request): HttpJsonResponse
    {
        $user = Auth::user();

        $followedId = $request->followed_user_id;
        // Verificar si ya sigue al usuario
        if (Following::where('user_id', $user->id)->where('followed_user_id', $followedId)->exists()) {
            return JsonResponse::success('ERROR: Already following this user', 400);
        }

        $follower = Following::create([
            'user_id' => $user->id,
            'followed_user_id' => $request->followed_user_id,
        ]);

        return JsonResponse::success($follower, 'Follow success', 200);
    }

    public function destroy(string $id): HttpJsonResponse
    {
        $user = Auth::user();

        $following = $user->followedUsers->where('id', $id)->first();

        // Verificar si no sigue al usuario
        if (!$following) {
            return JsonResponse::error('ERROR: You are not following this user', 404);
        }

        $following->delete();
        return JsonResponse::success($following, 'Unfollow success', 200);
    }
}
