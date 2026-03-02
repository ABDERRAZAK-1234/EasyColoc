<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Categorie::latest()->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255|unique:categories',
        ]);

        Categorie::create([
            'titre' => $request->titre,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Categorie créée avec succès.');
    }

    /**
     * Show the form for editing a category.
     */
    public function edit(Categorie $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Categorie $category)
    {
        $request->validate([
            'titre' => 'required|string|max:255|unique:categories,titre,' . $category->id,
        ]);

        $category->update([
            'titre' => $request->titre,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Categorie mise à jour avec succès.');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Categorie $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categorie supprimée avec succès.');
    }
}
