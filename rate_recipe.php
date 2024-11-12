<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to rate a recipe.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $recipe_id = $_POST['recipe_id'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO ratings (recipe_id, user_id, rating) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $recipe_id, $user_id, $rating);

    if ($stmt->execute()) {
        echo "Rating submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Rate Recipe</title>
</head>
<body>
    <header>
        <h1>Recipe Sharing Platform</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="add_recipe.php">Add Recipe</a>
        <a href="view_recipes.php">View Recipes</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h2>Rate Recipe</h2>
        <form method="POST" action="rate_recipe.php">
            <input type="hidden" name="recipe_id" value="<?php echo $_GET['recipe_id']; ?>">
            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" min="1" max="5" required>
            <button type="submit">Submit Rating</button>
        </form>
    </div>
</body>
</html>
