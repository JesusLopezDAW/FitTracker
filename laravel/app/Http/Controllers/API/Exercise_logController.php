<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseLogRequest;
use App\Models\Exercise_log;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse as HttpJsonResponse;
use App\Helpers\JsonResponse;


class Exercise_logController extends Controller
{
    public function store(Request $request): HttpJsonResponse
    {
        $validator = Validator::make($request->all(), [
            'exercise_logs' => 'required|array',
            'exercise_logs.*.workout_id' => 'required|integer',
            'exercise_logs.*.exercise_id' => 'required|integer',
            'exercise_logs.*.user_id' => 'required|integer',
            'exercise_logs.*.fecha_registro' => 'required|date',
            'series' => 'required|array',
            'series.*.workout_id' => 'required|integer',
            'series.*.exercise_id' => 'required|integer',
            'series.*.reps' => 'required|integer',
            'series.*.kilograms' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        DB::beginTransaction();

        try {
            foreach ($request->exercise_logs as $log) {
                Exercise_log::create([
                    'workout_id' => $log['workout_id'],
                    'exercise_id' => $log['exercise_id'],
                    'user_id' => Auth::id(),
                    'fecha_registro' => $log['fecha_registro'],
                ]);
            }

            foreach ($request->series as $serie) {
                Serie::create([
                    'workout_id' => $serie['workout_id'],
                    'exercise_id' => $serie['exercise_id'],
                    'reps' => $serie['reps'],
                    'kilograms' => $serie['kilograms'],
                ]);
            }

            DB::commit();
            return JsonResponse::success('Data inserted successfully', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while inserting data'], 500);
        }
    }

    public function show(string $exerciseId): HttpJsonResponse
    {
        $user = Auth::user();
        $log = $user->exerciseLogs->where('exercise_id', $exerciseId);

        return JsonResponse::success($log, 'Success', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}