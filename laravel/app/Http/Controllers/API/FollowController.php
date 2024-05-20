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
        $followUser = User::find($id);
        if(!$followUser){
            return JsonResponse::error('ERROR: User not found', 404);
        }

        $user = Auth::user();

        if($user->id == $id){
            return JsonResponse::error('ERROR: Can not follow you', 401);
        }

        if($user->follows->contains($followUser->id)){
            return JsonResponse::error('ERROR: Already following', 401);
        }

        $follow = Follow::create([
            'user_id' => $user->id,
            'followed_user_id' => $followUser->id,
        ]);

        return JsonResponse::success($follow, 'Follow success', 200);

    }

    public function unfollow(string $id)
    {
        $unfollowUser = User::find($id);
        $user = Auth::user();
        
        if(!$user->follows->contains($unfollowUser->id)){
            return JsonResponse::error('ERROR: Not following', 401);
        }
        $follow = Follow::where('user_id', $user->id)->where('followed_user_id', $unfollowUser->id);
        $follow->delete();
        return JsonResponse::success($follow, 'Unfollow success', 201);
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

    public function followingNumber()
    {
        return JsonResponse::success(Auth::user()->follows->count(), 'Success', 200);
    }
}
