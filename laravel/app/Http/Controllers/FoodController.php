<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\User;
use Carbon\Carbon;
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
        $userId = Auth::id();
        $visibility = User::find($userId)->isAdmin() ? 'global' : 'user';

        $validatedData = $request->validate([
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
        ]);

        $validatedData['user_id'] = $userId;
        $validatedData['visibility'] = $visibility;
        $validatedData['extra_info'] = "Creado desde el panel de administracion";

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images/foods');
            $imageFullPath = storage_path('app/' . $imagePath);
            $imageBinary = file_get_contents($imageFullPath);
            $imagenBase64 = base64_encode($imageBinary);
            $imagenDataURL = "data:image/jpeg;base64," . $imagenBase64;
            $validatedData['image'] = $imagenDataURL;
        }

        $food = Food::create($validatedData);
        return response()->json(['message' => 'Alimento creado correctamente', 'food' => $food], 201);
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
            'sugar_g' => $request->input('sugar_g'),
            'visibility' => $request->input("visibility")
        ]);

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

    public function getFoodsByPeriod($period)
    {
        // Obtener la fecha de inicio según el período seleccionado
        $startDate = $this->getStartDate($period);

        // Obtener los ejercicios creados desde la fecha de inicio hasta ahora
        $foods = Food::where('created_at', '>=', $startDate)->get();

        // Devolver los ejercicios como respuesta JSON
        return response()->json($foods);
    }

    private function getStartDate($period)
    {
        // Calcular la fecha de inicio según el período seleccionado
        switch ($period) {
            case 'hoy':
                return Carbon::now()->startOfDay();
            case 'ultima_semana':
                return Carbon::now()->subWeek()->startOfDay();
            case 'ultimo_mes':
                return Carbon::now()->subMonth()->startOfDay();
            case 'ultimos_3_meses':
                return Carbon::now()->subMonths(3)->startOfDay();
            case 'ultimos_6_meses':
                return Carbon::now()->subMonths(6)->startOfDay();
            case 'ultimo_ano':
                return Carbon::now()->subYear()->startOfDay();
            case 'global':
            default:
                return Carbon::now()->startOfDay();
        }
    }
}
