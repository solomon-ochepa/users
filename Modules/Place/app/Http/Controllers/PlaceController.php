<?php

namespace Modules\Place\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Place\app\Models\Place;

class PlaceController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:places.index'])->only('index');
        $this->middleware(['permission:places.show'])->only('show');
        $this->middleware(['permission:places.create'])->only('create', 'store');
        $this->middleware(['permission:places.edit'])->only('edit', 'update');
        $this->middleware(['permission:places.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $this->data['head']['title'] = 'place';

        return response(view('place::index', $this->data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $this->data['head']['title'] = 'Create place';

        return response(view('place::create', $this->data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        session()->flash('status', 'Record created successfully.');
        return redirect(route('place.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place): Response
    {
        $this->data['head']['title'] = '';

        $this->data['place'] = $place;

        return response(view('place::show', $this->data));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place): Response
    {
        $this->data['head']['title'] = '';

        $this->data['place'] = $place;

        return response(view('place::edit', $this->data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place): RedirectResponse
    {
        //
        session()->flash('status', 'Record updated successfully.');
        return redirect(route('place.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place): RedirectResponse
    {
        //
        session()->flash('status', 'Record deleted successfully.');
        return redirect(route('place.index'));
    }
}
