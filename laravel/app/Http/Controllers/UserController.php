<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Following;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        // Validar los datos del formulario


        // Crear un nuevo usuario con los datos del formulario
        $user = new User([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Se encripta la contraseña
            'profile_photo_path' => $request->profile_photo_path,
            'rol' => $request->rol,
        ]);

        // Guardar el usuario en la base de datos
        $user->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {
        $user = User::where('username', $username)->first();

        if ($user) {
            $routines = $user->routines()->with('workouts.exerciseLogs.exercise')->get();
            $posts = $user->posts()->with('workout.logs')->get();
            $exercisesPosts = $user->posts()->with('workout.exerciseLogs.exercise')->get();

            $workouts = $user->routines()->with('workouts')->get();
            $exercises = $user->exercises()->get();
            $foods = $user->foods()->get();
            $likes = $user->likes()->get();
            $likesRecibidos = $user->posts()->with('likes')->get();
            $commentsRecibidos = $user->posts()->with('comments')->get();
            $comments = $user->comments()->get();
            $followedUsers = $user->followedUsers()->get();
            $followers = $user->followers()->get();

            // Devolver los detalles del usuario a la vista
            return view("admin.user-details", compact('user', 'routines', "workouts", "followedUsers", "followers", "posts", "exercisesPosts", "comments", "commentsRecibidos", "likes", "likesRecibidos", "exercises", "foods"));
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
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $users = User::all();
            return response()->json(['message' => 'Usuario eliminado correctamente', 'data' => $users], 200);
        } else {
            // Devuelve una respuesta de error si el ejercicio no se encuentra
            return response()->json(['message' => 'No se encontró el usuario'], 404);
        }
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

    public function getUsersByPeriod($period)
    {
        // Obtener la fecha de inicio según el período seleccionado
        $startDate = $this->getStartDate($period);

        // Obtener los ejercicios creados desde la fecha de inicio hasta ahora
        $users = User::where('created_at', '>=', $startDate)->get();

        // Devolver los ejercicios como respuesta JSON
        return response()->json($users);
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

    public function getUsersByCountry()
    {
        // Realiza la consulta para contar el número de usuarios por país
        $usersByCountry = User::select('country', DB::raw('COUNT(*) as total'))
            ->groupBy('country')
            ->get();

        // Formatea los resultados en un arreglo asociativo
        $userCountByCountry = [];
        foreach ($usersByCountry as $user) {
            $userCountByCountry[$user->country] = $user->total;
        }

        // Devuelve la respuesta JSON
        return response()->json($userCountByCountry);
    }
}
