<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\RegisterRequest as RequestsRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    function register(RequestsRegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'status' => [
                'true' => true,
                'code' => 200
            ],
            'message' => 'Creado con exito',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);

    }

    function login(LoginRequest $request): JsonResponse
    {
        if(!Auth::attempt($request->only(['password', 'email']))){
            return response()->json([
                'status' => [
                    'true' => false,
                    'code' => 200
                ],
                'message' => 'Contraseña o email no validos'
            ], 200);
        }
        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => [
                'true' => true,
                'code' => 200
            ],
            'message' => 'Logeado con exito',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }

}
