<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add a recipe.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    $stmt = $conn->prepare("INSERT INTO recipes (user_id, title, description, ingredients, instructions) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $title, $description, $ingredients, $instructions);

    if ($stmt->execute()) {
        echo "Recipe added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Add Recipe</title>
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
        <h2>Add Recipe</h2>
        <form method="POST" action="add_recipe.php">
            <input type="text" name="title" placeholder="Recipe Title" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <textarea name="ingredients" placeholder="Ingredients" required></textarea>
            <textarea name="instructions" placeholder="Instructions" required></textarea>
            <button type="submit">Add Recipe</button>
        </form>
    </div>
</body>
</html>
