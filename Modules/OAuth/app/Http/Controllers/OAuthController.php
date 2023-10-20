<?php

namespace Modules\OAuth\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\OAuth\app\Models\OAuth;

class OAuthController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:oauths.index'])->only('index');
        $this->middleware(['permission:oauths.show'])->only('show');
        $this->middleware(['permission:oauths.create'])->only('create', 'store');
        $this->middleware(['permission:oauths.edit'])->only('edit', 'update');
        $this->middleware(['permission:oauths.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $this->data['head']['title'] = 'oauth';

        return response(view('oauth::index', $this->data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $this->data['head']['title'] = 'Create oauth';

        return response(view('oauth::create', $this->data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        session()->flash('status', 'Record created successfully.');

        return redirect(route('oauth.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(OAuth $oauth): Response
    {
        $this->data['head']['title'] = '';

        $this->data['oauth'] = $oauth;

        return response(view('oauth::show', $this->data));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OAuth $oauth): Response
    {
        $this->data['head']['title'] = '';

        $this->data['oauth'] = $oauth;

        return response(view('oauth::edit', $this->data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OAuth $oauth): RedirectResponse
    {
        //
        session()->flash('status', 'Record updated successfully.');

        return redirect(route('oauth.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OAuth $oauth): RedirectResponse
    {
        //
        session()->flash('status', 'Record deleted successfully.');

        return redirect(route('oauth.index'));
    }
}
