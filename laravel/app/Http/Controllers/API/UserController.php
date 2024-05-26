<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Validar la entrada
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // $user = User::where('name', 'LIKE', '%' . $query . '%')->get();

        $transformedUsers = User::where('name', 'LIKE', '%' . $query . '%')->get()->transform(function ($user) {
            return $user->transform();
        });
    
        // Crear una nueva instancia de LengthAwarePaginator para los resultados transformados
        $paginatedUsers = new \Illuminate\Pagination\LengthAwarePaginator(
            $transformedUsers,
            $transformedUsers->count(),
            10,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return response()->json($paginatedUsers);
    }
}
