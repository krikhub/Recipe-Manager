<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Recipe Manager')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-gray-900 border-b border-gray-700">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <a class="flex items-center text-xl font-bold text-white" href="{{ route('recipes.index') }}">
                        <i class="fas fa-utensils mr-2"></i>Recipe Manager
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" href="{{ route('recipes.index') }}">
                            <i class="fas fa-list mr-1"></i>All Recipes
                        </a>
                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" href="{{ route('recipes.create') }}">
                            <i class="fas fa-plus mr-1"></i>Add Recipe
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.parentElement.style.display='none'">
                        <span class="text-green-500">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        // Add loading states to forms
        document.querySelectorAll('form[method="POST"], form[method="post"]').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';
                    submitBtn.disabled = true;
                }
            });
        });
    </script>
</body>
</html>