<?php

namespace Modules\User\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\app\Models\User;

class UserController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:users.index'])->only('index');
        $this->middleware(['permission:users.show'])->only('show');
        $this->middleware(['permission:users.create'])->only('create', 'store');
        $this->middleware(['permission:users.edit'])->only('edit', 'update');
        $this->middleware(['permission:users.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $this->data['head']['title'] = 'user';

        return response(view('user::index', $this->data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $this->data['head']['title'] = 'Create user';

        return response(view('user::create', $this->data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        session()->flash('status', 'Record created successfully.');

        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        $this->data['head']['title'] = '';

        $this->data['user'] = $user;

        return response(view('user::show', $this->data));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): Response
    {
        $this->data['head']['title'] = '';

        $this->data['user'] = $user;

        return response(view('user::edit', $this->data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        //
        session()->flash('status', 'Record updated successfully.');

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        //
        session()->flash('status', 'Record deleted successfully.');

        return redirect(route('user.index'));
    }
}
