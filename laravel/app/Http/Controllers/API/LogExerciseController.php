<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseLogRequest;
use App\Models\Exercise_log;
use App\Models\ExerciseLog;
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

    private function validateExist(Exercise_Log | string $log)
    {
        if(!$log){
            return JsonResponse::error('ERROR: Log doesnt exist', 404);
        }
    }

    private function isFromUser(Exercise_Log $log, int $userId){
        if ($log->user_id != $userId) {
            return JsonResponse::error('Error: This Log is not from this user', 401);
        }
    }
}
