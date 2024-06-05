<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $data = $request->only('first_name', 'last_name', 'email', 'login');
        $data['password'] =  Hash::make($request->password);

        $user = User::create($data);


//       $user = User::create([
//           'first_name' => $request->first_name,
//           'last_name' => $request->last_name,
//           'email' => $request->email,
//           'login' => $request->login,
//           'password' => Hash::make($request->password)
//       ]);

       if ($user) {
           return response()->json([
               'success' => true,
               'message' => 'Success'
           ]);
       }

//        User::create($request->all());




    }

    public function login(LoginRequest $request)
    {
//        $validator = Validator::make($request->all(), [
//            'login' => 'required',
//            'password' => 'required'
//        ]);
//
//        if ($validator->fails())
//        {
//            return  response()->json([
//               'errors' => $validator->errors()
//            ]);
//        }


        $user = User::where('login', $request->login)->first();



        if ($user && Hash::check($request->password, $user->password)) {

            $user->api_token = Str::random(8);

            $user->save();

            return response()->json([
                'message' => "Вы успешно авторизовались!",
                'token' => $user->api_token,
            ]);
        }

        return response()->json([
            'message' => "Были допущены ошибки",
            'errors' => [
                'login' => ['Не верный логин или пароль']
            ]
        ], 422);
    }
}
