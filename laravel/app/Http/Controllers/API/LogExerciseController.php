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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function getByWorkoutId(Request $request)
    {
        // Obtener los parámetros de la solicitud
        $postId = $request->input('post_id');
        $workoutId = $request->input('workout_id');

        $postData = DB::select('SELECT 
            p.image AS post_image,
            u.id AS user_id,
            u.username AS user_username,
            u.profile_photo_path AS user_image,
            w.name AS workout_name,
            w.description AS workout_description
        FROM 
            posts p
            INNER JOIN users u ON p.user_id = u.id
            INNER JOIN workouts w ON p.workout_id = w.id
        WHERE 
            p.id = ?
        ', [$postId]);

        // Verificar si se encontró el post
        if (empty($postData)) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        // Consulta para obtener los datos del workout
        $workoutData = DB::select("SELECT se.kilograms, se.reps, e.name AS exercise_name, e.image AS exercise_image
        FROM exercise_logs el
        LEFT JOIN series se ON el.exercise_id = se.exercise_id
        LEFT JOIN exercises e ON el.exercise_id = e.id
        WHERE el.workout_id = ?
        AND EXISTS (
            SELECT 1
            FROM posts p
            WHERE p.id = ?
            AND se.created_at BETWEEN DATE_SUB(p.created_at, INTERVAL 5 MINUTE)
            AND DATE_ADD(p.created_at, INTERVAL 5 MINUTE)
        )", [$workoutId, $postId]);

        // Crear el objeto de respuesta
        $response = [
            "postData" => $postData,
            "workoutData" => $workoutData
        ];

        return response()->json([
            'success' => true,
            'data' => $response,
            'message' => 'Success'
        ], 200);
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
