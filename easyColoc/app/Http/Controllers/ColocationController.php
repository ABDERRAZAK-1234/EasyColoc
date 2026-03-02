<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Models\Colocation;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colocation = Colocation::whereHas('memberships', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->with('memberships.user')
            ->latest()
            ->first();

        return view('colocations.index', compact('colocation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colocations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColocationRequest $request)
    {
        $colocation = Colocation::create($request->validated());

        $colocation->memberships()->create([
            'user_id' => auth()->id(),
            'role' => 'owner',
            'joined_at' => now(),
        ]);
        auth()->user()->update([
            'colocation_id' => $colocation->id
        ]);

        return redirect()->route('colocations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colocation $colocation)
    {
        $colocation->load('memberships.user');
        return view('colocations.show', compact('colocation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colocation $colocation)
    {
        return view('colocations.edit', compact('colocation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColocationRequest $request, Colocation $colocation)
    {
        $colocation->update($request->validated());
        return redirect()->route('colocations.index')
            ->with('success', 'Colocation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colocation $colocation)
    {
        $colocation->delete();
        return redirect()->route('colocations.index');
    }
}
