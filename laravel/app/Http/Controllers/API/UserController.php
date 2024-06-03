<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        // Validar que el parámetro 'search' esté presente
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $search = $request->input('query');

        $users = User::search($search)->paginate(10);

        return response()->json($users);
    }
}
