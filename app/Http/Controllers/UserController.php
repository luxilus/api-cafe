<?php

namespace App\Http\Controllers;

use App\Exceptions\APIException;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
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
    function store(UserAddRequest $request)
    {
        $user = User::create($request->all() + [
                'photo_file' =>
                    $request->photo_file ? $request->photo_file->store('photos') : null
            ]);

        return response()->json([
            'data' => [
                'id' => $user->id,
                'status' => 'created',
            ]
        ]);
    }

    public
    function index()
    {
//        вернуть одного пользователя
//        return new UserResource(User::first());
//        вернуть коллекцию пользователей
//        return new UserCollection(User::all());
        return new UserCollection(User::all());
    }

}
