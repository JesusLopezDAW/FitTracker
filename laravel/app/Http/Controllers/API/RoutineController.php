<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoutineRequest;
use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;


class RoutineController extends Controller
{
    public function index(): HttpJsonResponse
    {
        $routines = Auth::user()->routines()
        ->with('workouts:id,name,routine_id')
        ->get(['id', 'name']);
    
        
        return JsonResponse::success($routines, 'success', 200);
    }

    public function store(RoutineRequest $request): HttpJsonResponse
    {
        $userId = Auth::id();
       
        $routine = Routine::create([
            'name' => $request->name,
            'type' => $request->type,
            'user_id' => $userId,
        ]);

        return JsonResponse::success($routine, 'Created successfully', 200);
    }

    public function show(string $id): HttpJsonResponse
    {
        $routine = $this->routineExist($id);

        $this->routineFromUser($routine->user_id);

        return JsonResponse::success($routine, 'success', 200);
    }

    public function update(RoutineRequest $request, string $id): HttpJsonResponse
    {
        $routine = $this->routineExist($id);
        $this->routineFromUser($routine->user_id);

        $routine->update($request);
        return JsonResponse::success($routine, 'Updated successfully', 200);
    }

    public function destroy(string $id): HttpJsonResponse
    {
        $routine = $this->routineExist($id);
        
        $this->routineFromUser($routine->user_id);

        $routine->delete();
        return JsonResponse::success($routine, 'Deleted successfully', 200);
    }

    private function routineFromUser(string $id): HttpJsonResponse
    {
        if ($id !== Auth::id()) {
            return JsonResponse::error('Error: This routine is not from this user', 401);
        }
    }

    private function routineExist($id): Routine | HttpJsonResponse
    {
        $routine = Routine::findOrFail($id);

        if(!$routine){
            return JsonResponse::error('Error: This routine doesnt exist', 404);
        }
        return $routine;
    }
}
