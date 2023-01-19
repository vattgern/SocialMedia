<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signUp(Request $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::attempt($request->all())) {
            return response()->json([
                'msg' => 'Пользователь уже создан',
                'status' => false,
            ]);
        }
        $user = User::create([
            'name' =>  $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'avatar' => 'default',
            'category' => null,
            'background' => 'default',
            'city' => null,
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'code' => 200,
        ]);
    }
    public function signIn(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!Auth::attempt($request->all())) {
            return response()->json([
                'msg' => 'Неверные данные',
                'code' => 401
            ]);
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'code' => 200,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function me(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }
    public function logout(): \Illuminate\Http\JsonResponse
    {
        //Удаление токенов
        auth()->user()->tokens()->delete();
        return response()->json([
            'msg' => 'Вы вышли'
        ]);
    }
}
