<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkoutRequest;
use App\Models\Routine;
use App\Models\Workout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;


class WorkoutController extends Controller
{
    public function index(): HttpJsonResponse
    {
        $user = Auth::user();
        $workouts = Workout::whereHas('routine', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        return JsonResponse::success($workouts, 'success', 200);
    }

    public function getRoutineWorkout(string $id): HttpJsonResponse
    {
        $user = Auth::user();
        $workout = $user->workouts()->where('id', $id)->first();

        if (!$workout) {
            return response()->json(['error' => 'Workout not found'], 404);
        }

        $logs = $workout->exerciseLogs()->with(['exercise' => function ($query) {
            $query->select('id', 'name', 'image')->with(['series' => function ($query) {
                $query->select('id', 'exercise_id', 'reps', 'kilograms'); 
            }]);
        }])->get();
        $exercises = [];

        $logs->each(function ($log) use (&$exercises) {
            $exercises[] = [
                'exercise' =>$log->exercise
            ];
        });

        return JsonResponse::success($exercises, 'success', 200);
    }

    // IMPLEMENTAR DEVOLVER EL FALLO
    public function store(WorkoutRequest $request)
    {
        $user = Auth::user();

        // // Verificar que la rutina pertenece al usuario autenticado
        // $routine = Routine::where('id', $request->input('routine_id'))->where('user_id', $user->id)->first();
        // if (!$routine) {
        //     return JsonResponse::error('Error: This routine is not from this user', 401);
        // }
        $data = $request->validated();
        $data['user_id'] = $user->id;
        // Crear el nuevo workout
        $workout = Workout::create($data);
        return JsonResponse::success($workout, 'workout created successfully', 200);
    }

    public function show(string $id): HttpJsonResponse
    {
        $user = Auth::user();
        $workout = Workout::whereHas('routine', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->find($id);

        if (!$workout) {
            return JsonResponse::error('Error: Workout not found or access denied', 404);
        }

        return JsonResponse::success($workout, 'Success', 200);
    }

    public function update(WorkoutRequest $request, string $id): HttpJsonResponse
    {
        $user = Auth::user();
        $workout = Workout::whereHas('routine', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->find($id);

        if (!$workout) {
            return JsonResponse::error('Error: Workout not found or access denied', 404);
        }

        $workout->update($request->all());

        return JsonResponse::success($workout, 'Update success', 200);
    }

    public function destroy(string $id): HttpJsonResponse
    {
        $user = Auth::user();
        $workout = Workout::whereHas('routine', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->find($id);

        if (!$workout) {
            return JsonResponse::error('Error: Workout not found or access denied', 404);
        }

        $workout->delete();

        return JsonResponse::success($workout, 'Delete success', 200);
    }

    public function workoutExercisesLogs(string $id)
    {
        $user = Auth::user();
        $workout = Workout::whereHas('routine', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->find($id);

        if (!$workout) {
            return JsonResponse::error('Error: Workout not found or access denied', 404);
        }

        return JsonResponse::success($workout->exerciseLogs()->with('exercise')->get(), 'Success', 200);
    }
}
