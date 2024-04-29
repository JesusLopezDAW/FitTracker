<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function listUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function update(Request $request)
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

        return "success";
    }

    public function show($userName)
    {
        // Buscar el usuario por el nombre
        $user = User::where('name', $userName)->first();

        // Verificar si el usuario existe
        if ($user) {
            // Obtener el ID del usuario
            $userId = $user->id;

            // Buscar al usuario utilizando el ID
            $user = User::find($userId);

            // Devolver los detalles del usuario a la vista
            return view("admin.user-details", ['user' => $user]);
        } else {
            // Si el usuario no existe, podrías manejarlo de alguna manera
            // aquí, como mostrar un mensaje de error o redirigir a otra página
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    }
}
