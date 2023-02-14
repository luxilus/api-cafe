<?php

namespace App\Http\Controllers;

use App\Exceptions\APIException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController
{
    public
    function login(Request $request)
    {
        $user = User::where([
            'login' => $request->login,
            'password' => $request->password,
        ])->first();
        if (!$user) {
            throw new APIException(401, 'Неверный логин или пароль');
        }
        return response()->json([
            'data' => [
                'user_token' => $user->generateToken(),
            ]
        ]);
    }

    public
    function logout()
    {
        Auth::user()->logoutToken();
        return [
            'message' => 'Выход'
        ];
    }

    public
    function store()
    {
        return "Добавление сотрудника";
    }

    public
    function index()
    {
        return DB::table('users')->get();
    }
}
