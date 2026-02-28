<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepenseRequest;
use App\Models\Colocation;
use App\Models\depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(DepenseRequest $request, Colocation $colocation)
    {
        $colocation->depenses()->create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Dépense ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(depense $depense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, depense $depense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colocation $colocation, Depense $depense)
    {
        $depense->delete();

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Dépense supprimée.');
    }
}
