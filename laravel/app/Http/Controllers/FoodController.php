<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function index(): View
    {
        $foods = Food::all();
        return view('admin.foods', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear un nuevo usuario con los datos del formulario
        $food = new Food([
            'user_id' => Auth::id(),
            'calories' => $request->calories,
            'carbohydrate_total_g' => $request->carbohydrate_total_g,
            'extra_info' => $request->extra_info,
            'fiber_g' => $request->fiber_g,
            'name' => $request->name,
            'potassium_mg' => $request->potassium_mg,
            'protein_g' => $request->protein_g,
            'saturated_fat_g' => $request->saturated_fat_g,
            'size_portion_g' => $request->size_portion_g,
            'sodium_mg' => $request->sodium_mg,
            'sugar_g' => $request->sugar_g,
            'total_fat_g' => $request->total_fat_g
        ]);

        // Guardar el alimento en la base de datos
        $food->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $food = Food::find($request->id);

        if (!$food) {
            return response()->json(['error' => 'No se encontró el alimento'], 404);
        }

        $food->update([
            'calories' => $request->input('calories'),
            'total_fat_g' => $request->input('total_fat_g'),
            'name' => $request->input('name'),
            'saturated_fat_g' => $request->input('saturated_fat_g'),
            'protein_g' => $request->input('protein_g'),
            'sodium_mg' => $request->input('sodium_mg'),
            'potassium_mg' => $request->input('potassium_mg'),
            'carbohydrate_total_g' => $request->input('carbohydrate_total_g'),
            'size_portion_g' => $request->input('size_portion_g'),
            'fiber_g' => $request->input('fiber_g'),
            'sugar_g' => $request->input('sugar_g')
        ]);;
        $food->save();

        return response()->json(['message' => 'Alimento actualizado correctamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Food::find($id);
        if ($food) {
            $food->delete();
            // Recupera los datos actualizados después de eliminar el ejercicio
            $foods = food::all();
            // Devuelve una respuesta de éxito junto con los datos actualizados
            return response()->json(['message' => 'Alimento eliminado correctamente', 'data' => $foods], 200);
        } else {
            // Devuelve una respuesta de error si el ejercicio no se encuentra
            return response()->json(['message' => 'No se encontró el alimento'], 404);
        }
    }
}
