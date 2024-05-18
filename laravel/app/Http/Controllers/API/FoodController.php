<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

class FoodController extends Controller
{
    public function index(): HttpJsonResponse
    {
        $user = Auth::user();

        $globalFood = Food::where('visibility', 'global')->get();

        $userFood = Food::where('visibility', 'user')
            ->where('user_id', $user->id)
            ->get();

        $foods = [
            "globals" => $globalFood,
            "user" => $userFood
        ];

        return JsonResponse::success($foods, 'success', 200);
    }

    public function store(FoodRequest $request): HttpJsonResponse
    {
        $userId = Auth::id();
        $visibility = Food::find($userId)->isAdmin() ? 'global' : 'user';

        $request['user_id'] = $userId;
        $request['visibility'] = $visibility;
        $request['extra_info'] = "Creado desde frontal";

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images/foods');
            $imageFullPath = storage_path('app/' . $imagePath);
            $imageBinary = file_get_contents($imageFullPath);
            $imagenBase64 = base64_encode($imageBinary);
            $imagenDataURL = "data:image/jpeg;base64," . $imagenBase64;
            $request['image'] = $imagenDataURL;
        }

        $food = Food::create($request);
        return JsonResponse::success($food, 'Store success', 201);
    }

    public function show(string $id): HttpJsonResponse
    {
        $userId = Auth::id();

        $food = Food::find($id);

        if (!$food) {
            return JsonResponse::error('Error: This food do not exist', 400);
        }

        if ($food->visibility != 'global' && $food->user_id != $userId) {
            return JsonResponse::error('Error: This food is not from this user', 401);
        }

        return JsonResponse::success($food, 'Success', 200);
    }

    public function update(FoodRequest $request, string $id): HttpJsonResponse
    {
        $userId = Auth::id();

        $food = Food::find($id);

        if (!$food) {
            return JsonResponse::error('Error: This food do not exist', 400);
        }

        if ($food->visibility != 'global' && $food->user_id != $userId) {
            return JsonResponse::error('Error: This food is not from this user', 401);
        }

        $food->update($request->all());
        
        return JsonResponse::success($food, 'Update success', 200);
    }

    public function destroy(string $id): HttpJsonResponse
    {
        $userId = Auth::id();

        $food = food::find($id);

        if (!$food) {
            return JsonResponse::error('Error: This food do not exist', 400);
        }

        if ($food->visibility != 'global' && $food->user_id != $userId) {
            return JsonResponse::error('Error: This food is not from this user', 401);
        }

        $food->delete();

        return JsonResponse::success($food, 'Delete success', 200);
    }
}
