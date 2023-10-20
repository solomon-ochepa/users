<?php

namespace Modules\User\app\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public array $data = [];

    /**
     * Display the auth user.
     */
    public function user(): JsonResponse
    {
        $user = auth()->user();

        $this->data['data']['user'] = $user;

        return response()->json($this->data)->setStatusCode(200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //

        return response()->json($this->data)->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //

        return response()->json($this->data)->setStatusCode(200);
    }

    /**
     * Show the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        //

        $this->data['data']['user'] = $user;

        return response()->json($this->data)->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): JsonResponse
    {
        //

        $this->data['data']['user'] = $user;

        return response()->json($this->data)->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        //

        return response()->json($this->data)->setStatusCode(200);
    }
}
