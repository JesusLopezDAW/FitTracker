<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoutineRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'type' => 'nullable|in:cardio,entrenamiento_de_fuerza,HIIT,yoga,pilates,flexibilidad,calistenia,kickboxing,crossfit,natación,ciclismo,correr,escalada,danza,artes_marciales,aeróbicos,otros',
        ];
    }
}
