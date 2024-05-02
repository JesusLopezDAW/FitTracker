<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
            $routines = $user->routines()->with('workouts')->get();
            // Devolver los detalles del usuario a la vista
            return view("admin.user-details", compact('user', 'routines'));
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

    public function getUsersRegisteredPerDay()
    {
        // Obtener los datos de usuarios registrados por día
        $usersPerDay = User::selectRaw('DATE(created_at) as date, COUNT(*) as users')
            ->whereBetween('created_at', [now()->subDays(30), now()]) // Obtener los datos de los últimos 30 días
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($usersPerDay);
    }

    public function getUsersRegisteredPerMonth()
    {
        // Obtener los datos de usuarios registrados por mes
        $usersPerMonth = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as date, COUNT(*) as users')
            ->whereBetween('created_at', [now()->subMonths(12), now()]) // Obtener los datos de los últimos 12 meses
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($usersPerMonth);
    }

    public function getUsersRegisteredPerYear()
    {
        // Obtener los datos de usuarios registrados por año
        $usersPerYear = User::selectRaw('YEAR(created_at) as date, COUNT(*) as users')
            ->whereBetween('created_at', [now()->subYears(5), now()]) // Obtener los datos de los últimos 5 años
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($usersPerYear);
    }
}
