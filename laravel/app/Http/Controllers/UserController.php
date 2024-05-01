<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
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
    public function show(string $username)
    {
        $user = User::where('username', $username)->first();

        if ($user) {
            // Devolver los detalles del usuario a la vista
            return view("admin.user-details", compact('user'));
        } else {
            // Si el usuario no existe, podrías manejarlo de alguna manera
            // aquí, como mostrar un mensaje de error o redirigir a otra página
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
