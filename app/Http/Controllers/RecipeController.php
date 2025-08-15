<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Recipe::query();
        
        // Handle search functionality
        $searchTerm = $request->filled('search') ? trim($request->get('search')) : null;
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                  ->orWhereRaw('LOWER(ingredients) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                  ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                  ->orWhereRaw('LOWER(instructions) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                  ->orWhereRaw('LOWER(category) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            });
        }
        
        // Handle category filtering - only apply if a specific category is selected
        $categoryFilter = $request->filled('category') ? $request->get('category') : null;
        if ($categoryFilter) {
            $query->where('category', $categoryFilter);
        }
        
        $recipes = $query->latest()->get();
        $categories = Recipe::whereNotNull('category')->distinct()->pluck('category')->sort();
        
        return view('recipes.index', compact('recipes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'description' => 'nullable|string',
            'prep_time' => 'nullable|string',
            'cook_time' => 'nullable|string',
            'servings' => 'nullable|integer',
            'difficulty' => 'nullable|string',
            'category' => 'nullable|string'
        ]);
        
        Recipe::create($request->all());
        
        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'description' => 'nullable|string',
            'prep_time' => 'nullable|string',
            'cook_time' => 'nullable|string',
            'servings' => 'nullable|integer',
            'difficulty' => 'nullable|string',
            'category' => 'nullable|string'
        ]);
        
        $recipe->update($request->all());
        
        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }
    
    public function exportJson()
    {
        $recipes = Recipe::all();
        
        return response()->json($recipes, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="recipes.json"'
        ]);
    }
}
