@extends('layouts.app')

@section('title', 'Edit Recipe - ' . $recipe->name . ' - Recipe Manager')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Edit Recipe: {{ $recipe->name }}
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('recipes.update', $recipe) }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-info-circle mr-1"></i>Basic Information
                            </h6>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="name" class="block text-sm font-medium text-gray-700 fw-bold">
                                Recipe Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $recipe->name) }}" required 
                                   placeholder="Enter your recipe name">
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="description" class="block text-sm font-medium text-gray-700 fw-bold">Description</label>
                            <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Briefly describe your recipe">{{ old('description', $recipe->description) }}</textarea>
                            @error('description')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Timing & Details Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-clock mr-1"></i>Timing & Details
                            </h6>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="prep_time" class="block text-sm font-medium text-gray-700 fw-bold">Prep Time</label>
                            <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('prep_time') is-invalid @enderror" 
                                   id="prep_time" name="prep_time" value="{{ old('prep_time', $recipe->prep_time) }}" 
                                   placeholder="e.g., 15 minutes">
                            @error('prep_time')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cook_time" class="block text-sm font-medium text-gray-700 fw-bold">Cook Time</label>
                            <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('cook_time') is-invalid @enderror" 
                                   id="cook_time" name="cook_time" value="{{ old('cook_time', $recipe->cook_time) }}" 
                                   placeholder="e.g., 30 minutes">
                            @error('cook_time')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="servings" class="block text-sm font-medium text-gray-700 fw-bold">Servings</label>
                            <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('servings') is-invalid @enderror" 
                                   id="servings" name="servings" value="{{ old('servings', $recipe->servings) }}" min="1" 
                                   placeholder="Number of servings">
                            @error('servings')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="difficulty" class="block text-sm font-medium text-gray-700 fw-bold">Difficulty</label>
                            <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty">
                                <option value="">Select difficulty level</option>
                                <option value="Easy" {{ old('difficulty', $recipe->difficulty) == 'Easy' ? 'selected' : '' }}>Easy</option>
                                <option value="Medium" {{ old('difficulty', $recipe->difficulty) == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Hard" {{ old('difficulty', $recipe->difficulty) == 'Hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                            @error('difficulty')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="block text-sm font-medium text-gray-700 fw-bold">Category</label>
                            <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('category') is-invalid @enderror" id="category" name="category">
                                <option value="">Select category</option>
                                <option value="Appetizer" {{ old('category', $recipe->category) == 'Appetizer' ? 'selected' : '' }}>Appetizer</option>
                                <option value="Main Course" {{ old('category', $recipe->category) == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                                <option value="Side Dish" {{ old('category', $recipe->category) == 'Side Dish' ? 'selected' : '' }}>Side Dish</option>
                                <option value="Dessert" {{ old('category', $recipe->category) == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                                <option value="Beverage" {{ old('category', $recipe->category) == 'Beverage' ? 'selected' : '' }}>Beverage</option>
                                <option value="Snack" {{ old('category', $recipe->category) == 'Snack' ? 'selected' : '' }}>Snack</option>
                                <option value="Breakfast" {{ old('category', $recipe->category) == 'Breakfast' ? 'selected' : '' }}>Breakfast</option>
                                <option value="Lunch" {{ old('category', $recipe->category) == 'Lunch' ? 'selected' : '' }}>Lunch</option>
                                <option value="Dinner" {{ old('category', $recipe->category) == 'Dinner' ? 'selected' : '' }}>Dinner</option>
                            </select>
                            @error('category')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Ingredients Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-shopping-cart mr-1"></i>Ingredients
                            </h6>
                            <label for="ingredients" class="block text-sm font-medium text-gray-700 fw-bold">
                                Ingredient List <span class="text-danger">*</span>
                            </label>
                            <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('ingredients') is-invalid @enderror" 
                                      id="ingredients" name="ingredients" rows="6" required 
                                      placeholder="List each ingredient on a new line, e.g.:&#10;2 cups all-purpose flour&#10;1 tsp salt&#10;3 large eggs">{{ old('ingredients', $recipe->ingredients) }}</textarea>
                            @error('ingredients')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Instructions Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-list-ol mr-1"></i>Instructions
                            </h6>
                            <label for="instructions" class="block text-sm font-medium text-gray-700 fw-bold">
                                Step-by-Step Instructions <span class="text-danger">*</span>
                            </label>
                            <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('instructions') is-invalid @enderror" 
                                      id="instructions" name="instructions" rows="8" required 
                                      placeholder="Write detailed step-by-step cooking instructions...">{{ old('instructions', $recipe->instructions) }}</textarea>
                            @error('instructions')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-between">
                        <a href="{{ route('recipes.show', $recipe) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-times mr-1"></i>Cancel
                        </a>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-save mr-1"></i>Update Recipe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection