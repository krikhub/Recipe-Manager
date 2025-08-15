@extends('layouts.app')

@section('title', 'Add New Recipe - Recipe Manager')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Add New Recipe
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('recipes.store') }}">
                    @csrf
                    
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
                                   id="name" name="name" value="{{ old('name') }}" required 
                                   placeholder="Enter your recipe name">
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="description" class="block text-sm font-medium text-gray-700 fw-bold">Description</label>
                            <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Briefly describe your recipe">{{ old('description') }}</textarea>
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
                                   id="prep_time" name="prep_time" value="{{ old('prep_time') }}" 
                                   placeholder="e.g., 15 minutes">
                            @error('prep_time')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cook_time" class="block text-sm font-medium text-gray-700 fw-bold">Cook Time</label>
                            <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('cook_time') is-invalid @enderror" 
                                   id="cook_time" name="cook_time" value="{{ old('cook_time') }}" 
                                   placeholder="e.g., 30 minutes">
                            @error('cook_time')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="servings" class="block text-sm font-medium text-gray-700 fw-bold">Servings</label>
                            <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('servings') is-invalid @enderror" 
                                   id="servings" name="servings" value="{{ old('servings') }}" min="1" 
                                   placeholder="Number of servings">
                            @error('servings')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="difficulty" class="block text-sm font-medium text-gray-700 fw-bold">Difficulty</label>
                            <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty">
                                <option value="">Select difficulty level</option>
                                <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                                <option value="Medium" {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                            @error('difficulty')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="block text-sm font-medium text-gray-700 fw-bold">Category</label>
                            <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('category') is-invalid @enderror" id="category" name="category">
                                <option value="">Select category</option>
                                <option value="Appetizer" {{ old('category') == 'Appetizer' ? 'selected' : '' }}>Appetizer</option>
                                <option value="Main Course" {{ old('category') == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                                <option value="Side Dish" {{ old('category') == 'Side Dish' ? 'selected' : '' }}>Side Dish</option>
                                <option value="Dessert" {{ old('category') == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                                <option value="Beverage" {{ old('category') == 'Beverage' ? 'selected' : '' }}>Beverage</option>
                                <option value="Snack" {{ old('category') == 'Snack' ? 'selected' : '' }}>Snack</option>
                                <option value="Breakfast" {{ old('category') == 'Breakfast' ? 'selected' : '' }}>Breakfast</option>
                                <option value="Lunch" {{ old('category') == 'Lunch' ? 'selected' : '' }}>Lunch</option>
                                <option value="Dinner" {{ old('category') == 'Dinner' ? 'selected' : '' }}>Dinner</option>
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
                                      placeholder="List each ingredient on a new line, e.g.:&#10;2 cups all-purpose flour&#10;1 tsp salt&#10;3 large eggs">{{ old('ingredients') }}</textarea>
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
                                      placeholder="Write detailed step-by-step cooking instructions...">{{ old('instructions') }}</textarea>
                            @error('instructions')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-between">
                        <a href="{{ route('recipes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-times mr-1"></i>Cancel
                        </a>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-save mr-1"></i>Save Recipe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection