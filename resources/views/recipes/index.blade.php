@extends('layouts.app')

@section('title', 'All Recipes - Recipe Manager')

@section('content')

<!-- Page Header -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold mb-0">
        <i class="fas fa-utensils mr-2"></i>Recipe Collection
    </h1>
    <div>
        <a href="{{ route('recipes.export.json') }}" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded mr-2">
            <i class="fas fa-download mr-1"></i>Export
        </a>
        <a href="{{ route('recipes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-1"></i>Add Recipe
        </a>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="bg-white shadow rounded-lg mb-4">
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8">
                <form method="GET" action="{{ route('recipes.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        <div class="md:col-span-6">
                            <label for="search" class="block text-sm font-medium text-gray-700">Search Recipes</label>
                            <input type="text" name="search" id="search" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Search by name, ingredients, or description..." 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="md:col-span-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-search mr-1"></i>Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="lg:col-span-4 text-right">
                @if(request('search') || request('category'))
                    <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                    <a href="{{ route('recipes.index') }}" class="block w-full bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded">
                        <i class="fas fa-times mr-1"></i>Clear Filters
                    </a>
                @endif
            </div>
        </div>
        
        @if(request('search') || request('category'))
            <div class="grid grid-cols-1 mt-3">
                <div class="col-span-1">
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded mb-0">
                        <small>
                            <strong>Applied Filters:</strong>
                            @if(request('search'))
                                Search: "{{ request('search') }}"
                            @endif
                            @if(request('search') && request('category')) | @endif
                            @if(request('category'))
                                Category: "{{ request('category') }}"
                            @endif
                            | Found {{ $recipes->count() }} recipe(s)
                        </small>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Recipe Cards -->
@if($recipes->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($recipes as $recipe)
            <div class="">
                <div class="bg-white shadow rounded-lg h-full flex flex-col">
                    @if($recipe->image)
                        <div class="h-48 bg-gray-200 rounded-t-lg overflow-hidden">
                            <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <h5 class="text-lg font-semibold mb-1">{{ $recipe->name }}</h5>
                            @if($recipe->category)
                                <span class="bg-blue-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">{{ $recipe->category }}</span>
                            @endif
                        </div>
                        
                        @if($recipe->description)
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($recipe->description, 120) }}</p>
                        @endif
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-0 text-gray-500 text-sm mb-3">
                            @if($recipe->prep_time)
                                <div class="">
                                    <i class="far fa-clock mr-1"></i>{{ $recipe->prep_time }}
                                </div>
                            @endif
                            @if($recipe->cook_time)
                                <div class="">
                                    <i class="fas fa-fire mr-1"></i>{{ $recipe->cook_time }}
                                </div>
                            @endif
                            @if($recipe->servings)
                                <div class="">
                                    <i class="fas fa-users mr-1"></i>{{ $recipe->servings }}
                                </div>
                            @endif
                            @if($recipe->difficulty)
                                <div class="">
                                    <i class="fas fa-star mr-1"></i>{{ $recipe->difficulty }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-4 border-t border-gray-200">
                        <div class="flex w-full space-x-2">
                            <a href="{{ route('recipes.show', $recipe) }}" class="flex-1 text-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded text-sm">
                                <i class="fas fa-eye mr-1"></i>View
                            </a>
                            <a href="{{ route('recipes.edit', $recipe) }}" class="flex-1 text-center bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-1 px-2 border border-yellow-500 hover:border-transparent rounded text-sm">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1 px-2 border border-red-500 hover:border-transparent rounded text-sm" 
                                        onclick="return confirm('Are you sure you want to delete this recipe?')">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-12">
        <div class="mb-4">
            <i class="fas fa-search fa-4x text-muted"></i>
        </div>
        <h3 class="text-gray-500 text-xl font-semibold">No recipes found</h3>
        @if(request('search') || request('category'))
            <p class="text-gray-500">Try adjusting your search criteria or <a href="{{ route('recipes.index') }}" class="text-blue-600 hover:text-blue-800">view all recipes</a></p>
        @else
            <p class="text-gray-500">Get started by <a href="{{ route('recipes.create') }}" class="text-blue-600 hover:text-blue-800">adding your first recipe</a></p>
        @endif
    </div>
@endif
@endsection