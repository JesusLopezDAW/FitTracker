<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseLogRequest;
use App\Models\Exercise_log;
use App\Models\ExerciseLog;
use App\Models\Post;
use App\Models\Workout;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse as HttpJsonResponse;
use Illuminate\Support\Facades\Auth;

class LogExerciseController extends Controller
{
    public function store(ExerciseLogRequest $request): HttpJsonResponse
    {
        $logData = $request->validated();
        $logData['user_id'] = Auth::id();

        $log = Exercise_log::create($logData);

        return JsonResponse::success($log, 'Created successfuly', 200);
    }

    public function show(string $exerciseId): HttpJsonResponse
    {
        $user = Auth::user();
        $log = $user->exerciseLogs->where('exercise_id', $exerciseId);

        return JsonResponse::success($log, 'Success', 200);
    }

    public function update(ExerciseLogRequest $request, string $id): HttpJsonResponse
    {
        $exerciseLog = Exercise_Log::find($id);

        $this->validateExist($exerciseLog);
        $this->isFromUser($exerciseLog, Auth::id());

        $logData = $request->validated();
        $exerciseLog->update($logData);

        return JsonResponse::success($exerciseLog, 'Success', 200);
    }

    public function destroy(string $id): HttpJsonResponse
    {
        $log = Exercise_Log::find($id);

        $this->validateExist($log);
        $this->isFromUser($log, Auth::id());

        $log->delete();

        return JsonResponse::success($log, 'Success', 200);
    }

    public function getByWorkoutId($workoutId)
    {
        // Obtener el tiempo de publicación del post
        $postTime = Post::where('workout_id', $workoutId)->value('created_at');

        // Convertir el tiempo de publicación del post a una instancia de Carbon
        $postTime = Carbon::parse($postTime);

        // Obtener los registros de ejercicio por el ID de entrenamiento
        $logs = Exercise_log::where('workout_id', $workoutId)->get();

        // Filtrar las series por el mismo día y hora que el post
        $exercises = [];

        $logs->each(function ($log) use (&$exercises, $postTime) {
            $filteredSeries = $log->exercise->series->filter(function ($series) use ($postTime) {
                return $series->created_at->toDateString() == $postTime->toDateString() &&
                    $series->created_at->toTimeString() == $postTime->toTimeString();
            });

            // Agregar las series filtradas al array de ejercicios solo si hay series que coincidan
            if (!$filteredSeries->isEmpty()) {
                $exercises[] = [
                    'exercise' => $log->exercise,
                    'series' => $filteredSeries
                ];
            }
        });

        // Retornar la respuesta JSON
        return JsonResponse::success($exercises, 'Success', 200);
    }

    private function validateExist(Exercise_Log | string $log)
    {
        if (!$log) {
            return JsonResponse::error('ERROR: Log doesnt exist', 404);
        }
    }

    private function isFromUser(Exercise_Log $log, int $userId)
    {
        if ($log->user_id != $userId) {
            return JsonResponse::error('Error: This Log is not from this user', 401);
        }
    }
}
