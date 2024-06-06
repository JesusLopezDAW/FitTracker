<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;


class UserController extends Controller
{
    public function search(Request $request): HttpJsonResponse
    {
        // Validar que el parámetro 'search' esté presente
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $search = $request->input('query');

        $users = User::search($search)->paginate(10);

        return response()->json($users);
    }

    public function getProfileInfo(): HttpJsonResponse
    {
        $user = Auth::user();
        $image = $user->profile_photo_path;
        $username = $user->username;
        $name = $user->name;
        
        $data = [
            "image" => $image, 
            "username" => $username,
            "name" => $name];
        return JsonResponse::success($data, 'Successfully', 200);

    }

    public function getProfileInfoOtherUser($id): HttpJsonResponse
    {
        $user = User::find($id);
        $image = $user->profile_photo_path;
        $username = $user->username;
        $name = $user->name;
        
        $data = [
            "image" => $image, 
            "username" => $username,
            "name" => $name];
        return JsonResponse::success($data, 'Successfully', 200);

    }
}
