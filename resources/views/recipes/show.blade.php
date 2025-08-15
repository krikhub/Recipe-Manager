@extends('layouts.app')

@section('title', $recipe->name . ' - Recipe Manager')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-8">
        <!-- Recipe Header -->
        <div class="bg-white shadow rounded-lg mb-4">
            @if($recipe->image)
                <div class="h-64 bg-gray-200 rounded-t-lg overflow-hidden">
                    <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}" class="w-full h-full object-cover">
                </div>
            @endif
            <div class="bg-blue-500 text-white px-6 py-4 {{ $recipe->image ? '' : 'rounded-t-lg' }}">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-xl font-bold mb-1">
                            <i class="fas fa-utensils me-2"></i>{{ $recipe->name }}
                        </h1>
                        @if($recipe->category)
                            <span class="bg-white text-blue-500 text-xs font-medium px-2.5 py-0.5 rounded">
                                <i class="fas fa-tag me-1"></i>{{ $recipe->category }}
                            </span>
                        @endif
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('recipes.edit', $recipe) }}" class="bg-transparent hover:bg-white hover:text-blue-500 text-white font-semibold py-1 px-3 border border-white hover:border-transparent rounded text-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-transparent hover:bg-white hover:text-blue-500 text-white font-semibold py-1 px-3 border border-white hover:border-transparent rounded text-sm" 
                                    onclick="return confirm('Are you sure you want to delete this recipe?')">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @if($recipe->description)
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded mb-4">
                        <h6 class="font-semibold">
                            <i class="fas fa-info-circle me-1"></i>Description
                        </h6>
                        <p class="mb-0">{{ $recipe->description }}</p>
                    </div>
                @endif

                <!-- Recipe Meta Information -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    @if($recipe->prep_time)
                        <div class="">
                            <div class="text-center p-3 border border-gray-200 rounded">
                                <i class="far fa-clock fa-2x text-primary mb-2"></i>
                                <div class="text-sm text-gray-500">Prep Time</div>
                                <div class="font-bold">{{ $recipe->prep_time }}</div>
                            </div>
                        </div>
                    @endif
                    @if($recipe->cook_time)
                        <div class="">
                            <div class="text-center p-3 border border-gray-200 rounded">
                                <i class="fas fa-fire fa-2x text-danger mb-2"></i>
                                <div class="text-sm text-gray-500">Cook Time</div>
                                <div class="font-bold">{{ $recipe->cook_time }}</div>
                            </div>
                        </div>
                    @endif
                    @if($recipe->servings)
                        <div class="">
                            <div class="text-center p-3 border border-gray-200 rounded">
                                <i class="fas fa-users fa-2x text-success mb-2"></i>
                                <div class="text-sm text-gray-500">Servings</div>
                                <div class="font-bold">{{ $recipe->servings }}</div>
                            </div>
                        </div>
                    @endif
                    @if($recipe->difficulty)
                        <div class="">
                            <div class="text-center p-3 border border-gray-200 rounded">
                                <i class="fas fa-star fa-2x text-warning mb-2"></i>
                                <div class="text-sm text-gray-500">Difficulty</div>
                                <div class="font-bold">{{ $recipe->difficulty }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Ingredients Section -->
        <div class="bg-white shadow rounded-lg mb-4">
            <div class="bg-green-500 text-white px-6 py-4 rounded-t-lg">
                <h5 class="mb-0">
                    <i class="fas fa-shopping-cart me-2"></i>Ingredients
                </h5>
            </div>
            <div class="p-6">
                <ul class="divide-y divide-gray-200">
                    @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                        @if(trim($ingredient))
                            <li class="py-3 flex items-center">
                                <i class="fas fa-circle text-green-500 mr-2 text-xs"></i>
                                {{ trim($ingredient) }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Instructions Section -->
        <div class="bg-white shadow rounded-lg mb-4">
            <div class="bg-yellow-500 text-gray-900 px-6 py-4 rounded-t-lg">
                <h5 class="mb-0">
                    <i class="fas fa-list-ol me-2"></i>Instructions
                </h5>
            </div>
            <div class="p-6">
                <div class="leading-relaxed">
                    {!! nl2br(e($recipe->instructions)) !!}
                </div>
            </div>
        </div>

        <!-- Timestamps -->
        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <h6 class="text-lg font-semibold">Recipe Information</h6>
                <p class="text-sm text-gray-500">
                    <i class="fas fa-calendar-plus me-1"></i>
                    <strong>Created:</strong> {{ $recipe->created_at->format('M d, Y \a\t g:i A') }}
                </p>
                @if($recipe->updated_at != $recipe->created_at)
                    <p class="text-sm text-gray-500 mb-0">
                        <i class="fas fa-calendar-edit me-1"></i>
                        <strong>Last updated:</strong> {{ $recipe->updated_at->format('M d, Y \a\t g:i A') }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <div class="lg:col-span-4">
        <!-- Action Sidebar -->
        <div class="bg-white shadow rounded-lg sticky top-4">
            <div class="px-6 py-4 border-b border-gray-200">
                <h6 class="mb-0">
                    <i class="fas fa-tools me-1"></i>Quick Actions
                </h6>
            </div>
            <div class="p-6">
                <div class="space-y-2">
                    <a href="{{ route('recipes.index') }}" class="block text-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                        <i class="fas fa-arrow-left me-1"></i>Back to All Recipes
                    </a>
                    <a href="{{ route('recipes.edit', $recipe) }}" class="block text-center bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-edit me-1"></i>Edit This Recipe
                    </a>
                    <a href="{{ route('recipes.create') }}" class="block text-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-plus me-1"></i>Add New Recipe
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection