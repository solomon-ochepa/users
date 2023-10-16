<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $request["password"] = Hash::make($request["password"]);

        $user = User::create($request->safe()->only([
            "first_name",
            "last_name",
            "username",
            "phone",
            "email",
            "password",
        ]));

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'status' => true,
            'data' => [
                "access_token" => $token,
                "token_type" => "Bearer",
            ]
        ]);
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response([
            'status' => false,
            'data' => [
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ]
        ], 422);

        throw new ValidationException($validator, $response);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only("username", "password"))) {
            return response()->json([
                "status" => false,
                'data' => [
                    "message" => "Invalid login details",
                ]
            ], 401);
        }

        $user = User::where("username", $request["username"])->firstOrFail();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'status' => true,
            'data' => [
                "access_token" => $token,
                "token_type" => "Bearer",
            ]
        ]);
    }

    public function user(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => [
                'user' => $request->user()
            ]
        ]);
    }
}
