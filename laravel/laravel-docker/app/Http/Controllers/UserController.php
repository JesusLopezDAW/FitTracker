<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listarUsuarios(Request $request) {
        $usuarios = User::all();
        return response()->json($usuarios, 200);
    }
}
