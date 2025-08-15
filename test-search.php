<?php
// Simple test script to verify search functionality

require_once 'vendor/autoload.php';

use App\Models\Recipe;
use Illuminate\Database\Capsule\Manager as DB;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Get search parameter
$search = $_GET['search'] ?? '';

echo "<h1>Recipe Search Test</h1>";
echo "<form method='GET'>";
echo "<input type='text' name='search' value='" . htmlspecialchars($search) . "' placeholder='Search recipes...'>";
echo "<button type='submit'>Search</button>";
echo "</form>";

echo "<hr>";

if ($search) {
    echo "<h2>Searching for: " . htmlspecialchars($search) . "</h2>";
    
    $query = Recipe::query();
    $query->where(function($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('ingredients', 'like', "%{$search}%")
          ->orWhere('description', 'like', "%{$search}%");
    });
    
    $recipes = $query->get();
    
    echo "<p>Found " . $recipes->count() . " recipes:</p>";
    
    foreach ($recipes as $recipe) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
        echo "<h3>" . htmlspecialchars($recipe->name) . "</h3>";
        echo "<p>Category: " . htmlspecialchars($recipe->category ?? 'None') . "</p>";
        echo "<p>Description: " . htmlspecialchars($recipe->description ?? 'No description') . "</p>";
        echo "</div>";
    }
} else {
    echo "<h2>All Recipes:</h2>";
    $recipes = Recipe::all();
    
    foreach ($recipes as $recipe) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
        echo "<h3>" . htmlspecialchars($recipe->name) . "</h3>";
        echo "<p>Category: " . htmlspecialchars($recipe->category ?? 'None') . "</p>";
        echo "</div>";
    }
}
?>