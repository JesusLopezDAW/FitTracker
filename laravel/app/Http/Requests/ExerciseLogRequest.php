<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'workout_id' => 'required|exists:workouts,id',
            'exercise_id' => 'required|exists:exercises,id',
            'serie_type' => 'required|in:warm_up,normal,failed,drop',
            'series' => 'required|integer|min:0',
            'reps' => 'required|integer|min:0',
            'kilograms' => 'required|integer|min:0',
            'fecha_registro' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }
}
