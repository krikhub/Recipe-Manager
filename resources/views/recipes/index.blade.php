@extends('layouts.app')

@section('title', 'All Recipes - Recipe Manager')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">
        <i class="fas fa-utensils me-2"></i>Recipe Collection
    </h1>
    <div>
        <a href="{{ route('recipes.export.json') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-download me-1"></i>Export
        </a>
        <a href="{{ route('recipes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Add Recipe
        </a>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <form method="GET" action="{{ route('recipes.index') }}">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="search" class="form-label">Search Recipes</label>
                            <input type="text" name="search" id="search" class="form-control" 
                                   placeholder="Search by name, ingredients, or description..." 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-1"></i>Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 text-end">
                @if(request('search') || request('category'))
                    <label class="form-label">&nbsp;</label>
                    <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary d-block">
                        <i class="fas fa-times me-1"></i>Clear Filters
                    </a>
                @endif
            </div>
        </div>
        
        @if(request('search') || request('category'))
            <div class="row mt-3">
                <div class="col-12">
                    <div class="alert alert-info mb-0">
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
    <div class="row">
        @foreach($recipes as $recipe)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-1">{{ $recipe->name }}</h5>
                            @if($recipe->category)
                                <span class="badge bg-primary">{{ $recipe->category }}</span>
                            @endif
                        </div>
                        
                        @if($recipe->description)
                            <p class="card-text text-muted small mb-3">{{ Str::limit($recipe->description, 120) }}</p>
                        @endif
                        
                        <div class="row g-0 text-muted small mb-3">
                            @if($recipe->prep_time)
                                <div class="col">
                                    <i class="far fa-clock me-1"></i>{{ $recipe->prep_time }}
                                </div>
                            @endif
                            @if($recipe->cook_time)
                                <div class="col">
                                    <i class="fas fa-fire me-1"></i>{{ $recipe->cook_time }}
                                </div>
                            @endif
                            @if($recipe->servings)
                                <div class="col">
                                    <i class="fas fa-users me-1"></i>{{ $recipe->servings }}
                                </div>
                            @endif
                            @if($recipe->difficulty)
                                <div class="col">
                                    <i class="fas fa-star me-1"></i>{{ $recipe->difficulty }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-top">
                        <div class="btn-group w-100" role="group">
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                        onclick="return confirm('Are you sure you want to delete this recipe?')">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-search fa-4x text-muted"></i>
        </div>
        <h3 class="text-muted">No recipes found</h3>
        @if(request('search') || request('category'))
            <p class="text-muted">Try adjusting your search criteria or <a href="{{ route('recipes.index') }}">view all recipes</a></p>
        @else
            <p class="text-muted">Get started by <a href="{{ route('recipes.create') }}">adding your first recipe</a></p>
        @endif
    </div>
@endif
@endsection