<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LogRequest;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

class LogController extends Controller
{
    public function index(): HttpJsonResponse
    {
        return JsonResponse::success(Auth::user()->logs, 'Success', 200);
    }

    public function store(LogRequest $request): HttpJsonResponse
    {
        $logData = $request->validated();
        $logData['user_id'] = Auth::id();

        $log = Log::create($logData);
        return JsonResponse::success($log, 'Created successfuly', 200);
    }

    public function show(string $id): HttpJsonResponse
    {
        $log = Log::find($id);

        $this->validateExist($log);
        $this->isFromUser($log, Auth::id());

        return JsonResponse::success($log, 'Success', 200);
    }

    public function update(LogRequest $request, string $id): HttpJsonResponse
    {
        $log = Log::find($id);

        $this->validateExist($log);
        $this->isFromUser($log, Auth::id());

        $logData = $request->validated();
        $log->update($logData);

        return JsonResponse::success($log, 'Success', 200);
    }

    public function destroy(string $id): HttpJsonResponse
    {
        $log = Log::find($id);

        $this->validateExist($log);
        $this->isFromUser($log, Auth::id());
        
        $log->delete();

        return JsonResponse::success($log, 'Success', 200);
    }

    private function validateExist(Log | string $log)
    {
        if(!$log){
            return JsonResponse::error('ERROR: Log doesnt exist', 404);
        }
    }

    private function isFromUser(Log $log, int $userId){
        if ($log->user_id != $userId) {
            return JsonResponse::error('Error: This Log is not from this user', 401);
        }
    }

}
