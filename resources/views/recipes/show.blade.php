@extends('layouts.app')

@section('title', $recipe->name . ' - Recipe Manager')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <!-- Recipe Header -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-1">
                            <i class="fas fa-utensils me-2"></i>{{ $recipe->name }}
                        </h1>
                        @if($recipe->category)
                            <span class="badge bg-light text-primary">
                                <i class="fas fa-tag me-1"></i>{{ $recipe->category }}
                            </span>
                        @endif
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-light btn-sm" 
                                    onclick="return confirm('Are you sure you want to delete this recipe?')">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($recipe->description)
                    <div class="alert alert-info mb-4">
                        <h6 class="alert-heading">
                            <i class="fas fa-info-circle me-1"></i>Description
                        </h6>
                        <p class="mb-0">{{ $recipe->description }}</p>
                    </div>
                @endif

                <!-- Recipe Meta Information -->
                <div class="row mb-4">
                    @if($recipe->prep_time)
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="text-center p-3 border rounded">
                                <i class="far fa-clock fa-2x text-primary mb-2"></i>
                                <div class="small text-muted">Prep Time</div>
                                <div class="fw-bold">{{ $recipe->prep_time }}</div>
                            </div>
                        </div>
                    @endif
                    @if($recipe->cook_time)
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-fire fa-2x text-danger mb-2"></i>
                                <div class="small text-muted">Cook Time</div>
                                <div class="fw-bold">{{ $recipe->cook_time }}</div>
                            </div>
                        </div>
                    @endif
                    @if($recipe->servings)
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-users fa-2x text-success mb-2"></i>
                                <div class="small text-muted">Servings</div>
                                <div class="fw-bold">{{ $recipe->servings }}</div>
                            </div>
                        </div>
                    @endif
                    @if($recipe->difficulty)
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-star fa-2x text-warning mb-2"></i>
                                <div class="small text-muted">Difficulty</div>
                                <div class="fw-bold">{{ $recipe->difficulty }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Ingredients Section -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-shopping-cart me-2"></i>Ingredients
                </h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                        @if(trim($ingredient))
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-circle text-success me-2" style="font-size: 0.5rem;"></i>
                                {{ trim($ingredient) }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Instructions Section -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="fas fa-list-ol me-2"></i>Instructions
                </h5>
            </div>
            <div class="card-body">
                <div class="lh-lg">
                    {!! nl2br(e($recipe->instructions)) !!}
                </div>
            </div>
        </div>

        <!-- Timestamps -->
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Recipe Information</h6>
                <p class="card-text small text-muted">
                    <i class="fas fa-calendar-plus me-1"></i>
                    <strong>Created:</strong> {{ $recipe->created_at->format('M d, Y \a\t g:i A') }}
                </p>
                @if($recipe->updated_at != $recipe->created_at)
                    <p class="card-text small text-muted mb-0">
                        <i class="fas fa-calendar-edit me-1"></i>
                        <strong>Last updated:</strong> {{ $recipe->updated_at->format('M d, Y \a\t g:i A') }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Action Sidebar -->
        <div class="card position-sticky" style="top: 1rem;">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-tools me-1"></i>Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-1"></i>Back to All Recipes
                    </a>
                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit This Recipe
                    </a>
                    <a href="{{ route('recipes.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Add New Recipe
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection