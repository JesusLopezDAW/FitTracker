<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listarUsuarios()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function UpdateUsuario(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->username = $request->input('username');
        $user->phone_number = $request->input('phone_number');
        $user->birthdate = $request->input('birthdate');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->rol = $request->input('rol');

        $user->save();

        return response()->json(['message' => 'Usuario actualizado correctamente'], 200);
    }
}