<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseRequest extends FormRequest
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
            'name' => 'required|string',
            'type' => 'required|in:cardio,olympic_weightlifting,plyometrics,powerlifting,strength,stretching,strongman',
            'muscle' => 'nullable|in:abdominals,abductors,adductors,biceps,calves,chest,forearms,glutes,hamstrings,lats,lower_back,middle_back,neck,quadriceps,traps,triceps|string',
            'equipment' => 'nullable|string',
            'difficulty' => 'nullable|string|in:beginner,intermediate,expert',
            'instructions' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'type.required' => 'El campo tipo es obligatorio.',
            'muscle.required' => 'El campo músculo es obligatorio.',
            'equipment.required' => 'El campo equipo es obligatorio.',
            'difficulty.required' => 'El campo dificultad es obligatorio.',
            'instructions.required' => 'El campo instrucciones es obligatorio.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'status' => false,
            'message' => 'Error de validación',
            'errors' => $validator->errors()
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
