<?php
require 'db_connection.php';

$result = $conn->query("SELECT recipes.*, users.username FROM recipes JOIN users ON recipes.user_id = users.id");

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>View Recipes</title>
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
        <h2>Recipes</h2>

        <?php
        while ($recipe = $result->fetch_assoc()) {
            echo "<h2>" . $recipe['title'] . "</h2>";
            echo "<p>By: " . $recipe['username'] . "</p>";
            echo "<p>" . $recipe['description'] . "</p>";
            echo "<h3>Ingredients</h3><p>" . $recipe['ingredients'] . "</p>";
            echo "<h3>Instructions</h3><p>" . $recipe['instructions'] . "</p>";

            // Display ratings
            $rating_result = $conn->query("SELECT AVG(rating) as average_rating FROM ratings WHERE recipe_id = " . $recipe['id']);
            if ($rating_row = $rating_result->fetch_assoc()) {
                echo "<p>Average Rating: " . round($rating_row['average_rating'], 2) . "</p>";
            } else {
                echo "<p>No ratings yet.</p>";
            }

            // Display comments
            $comments_result = $conn->query("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE recipe_id = " . $recipe['id']);
            echo "<h3>Comments</h3>";
            while ($comment = $comments_result->fetch_assoc()) {
                echo "<p><strong>" . $comment['username'] . "</strong>: " . $comment['comment'] . "</p>";
            }

            echo "<a href='rate_recipe.php?recipe_id=" . $recipe['id'] . "'>Rate this recipe</a><br>";
            echo "<a href='comment_recipe.php?recipe_id=" . $recipe['id'] . "'>Leave a comment</a>";
        }
        ?>
    </div>
</body>
</html>
