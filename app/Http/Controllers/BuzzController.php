<?php

namespace App\Http\Controllers;

use App\Models\Buzz;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BuzzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('buzzs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'message' => 'required|string|max:255',

        ]);

 

        $request->user()->buzzs()->create($validated);

 

        return redirect(route('buzzs.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Buzz $buzz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buzz $buzz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buzz $buzz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buzz $buzz)
    {
        //
    }
}
