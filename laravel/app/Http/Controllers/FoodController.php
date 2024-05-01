<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        //
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
        //
    }
}
