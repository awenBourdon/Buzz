<?php

namespace App\Http\Controllers;

use App\Models\Buzz;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BuzzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('buzzs.index', [

            'buzzs' => Buzz::with('user')->latest()->get(),

        ]);
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        $buzz = new Buzz($validated);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('iSmage')->store('buzz_images', 'public');
            $buzz->image = $imagePath;
        }

        $request->user()->buzzs()->save($buzz);

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
    public function edit(Buzz $buzz): View
    {
        Gate::authorize('update', $buzz);

 

        return view('buzzs.edit', [

            'buzz' => $buzz,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buzz $buzz): RedirectResponse
    {
        Gate::authorize('update', $buzz);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        $buzz->message = $validated['message'];

        if ($request->hasFile('image')) {
            // Supprimez l'ancienne image si elle existe
            if ($buzz->image) {
                Storage::disk('public')->delete($buzz->image);
            }
           
            $imagePath = $request->file('image')->store('buzz_images', 'public');
            $buzz->image = $imagePath;
        }

        $buzz->save();

        return redirect(route('buzzs.index'));
    }
   
    public function destroy(Buzz $buzz): RedirectResponse
    {
        Gate::authorize('delete', $buzz);

        if ($buzz->image) {
            Storage::disk('public')->delete($buzz->image);
        }

        $buzz->delete();

        return redirect(route('buzzs.index'));
    }
}