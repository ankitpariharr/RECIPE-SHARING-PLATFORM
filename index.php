<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Recipe Sharing Platform</title>
</head>
<body>
    <header>
        <h1>Recipe Sharing Platform</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="add_recipe.php">Add a Recipe</a>
            <a href="view_recipes.php">View Recipes</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
    <div class="container">
        <h1>Welcome to the Recipe Sharing Platform</h1>
    </div>
</body>
</html>
