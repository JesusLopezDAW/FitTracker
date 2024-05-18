<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'calories' => 'required|integer',
            'size_portion_g' => 'required|integer',
            'total_fat_g' => 'required|integer',
            'saturated_fat_g' => 'required|integer',
            'protein_g' => 'required|integer',
            'sodium_mg' => 'required|integer',
            'potassium_mg' => 'required|integer',
            'carbohydrate_total_g' => 'required|integer',
            'fiber_g' => 'required|integer',
            'sugar_g' => 'required|integer'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'size_portion_g.required'  => 'El campo porcion es obligatorio.',
            'total_fat_g.required' => 'El campo grasas es obligatorio.',
            'saturated_fat_g.required' => 'El campo grasas saturadas es obligatorio.',
            'protein_g.required' => 'El campo proteina es obligatorio.',
            'sodium_mg.required' => 'El campo sodio es obligatorio.',
            'potassium_mg.required' => 'El campo potasio es obligatorio.',
            'carbohydrate_total_g.required' => 'El campo carbahidratos es obligatorio.',
            'fiber_g.required' => 'El campo fibra es obligatorio.',
            'sugar_g.required' => 'El campo azucar es obligatorio.',
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
