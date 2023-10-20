<?php

namespace Modules\OAuth\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\OAuth\app\Http\Requests\LoginRequest;
use Modules\OAuth\app\Http\Requests\RegistrationRequest;

class OAuthController extends Controller
{
    public $data = [];

    public function __construct()
    {
        //
    }

    public function register(RegistrationRequest $request)
    {
        $request['password'] = Hash::make($request['password']);

        $user = User::create($request->safe()->only(
            [
                'first_name',
                'last_name',
                'username',
                'phone',
                'email',
                'password',
            ]
        ));

        $token = $user->createToken($request->device_name)->accessToken;

        $this->data = [
            'status' => 'success',
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],
        ];

        return response()->json($this->data);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json(
                [
                    'status' => false,
                    'data' => [
                        'message' => 'Invalid login details',
                    ],
                ],
                401
            );
        }

        $user = User::where('username', $request['username'])->firstOrFail();

        $token = $user->createToken($request->device_name)->accessToken;

        $this->data = [
            'status' => 'success',
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],
        ];

        return response()->json($this->data);
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response([
            'status' => false,
            'data' => [
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ],
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
