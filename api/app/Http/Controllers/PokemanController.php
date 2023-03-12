<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePokemanRequest;
use App\Http\Requests\UpdatePokemanRequest;
use App\Models\Pokeman;

class PokemanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePokemanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokeman $pokeman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePokemanRequest $request, Pokeman $pokeman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokeman $pokeman)
    {
        //
    }
}
